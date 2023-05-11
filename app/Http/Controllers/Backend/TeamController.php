<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\TeamTranslation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class TeamController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('team index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $teams = Team::all();
        return view('backend.team.index', get_defined_vars());
    }

    public function create()
    {
        abort_if(Gate::denies('team create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.team.create');
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('team create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $team = new Team();
            $team->image = upload('teams', $request->file('image'));
            $team->save();
            foreach (active_langs() as $active_lang) {
                $translation = new TeamTranslation();
                $translation->name = $request->name[$active_lang->code];
                $translation->position = $request->position[$active_lang->code];
                $translation->alt = $request->alt[$active_lang->code];
                $translation->locale = $active_lang->code;
                $translation->team_id = $team->id;
                $translation->save();
            }
            alert()->success(__('messages.success'));
            return redirect(route('backend.team.index'));
        } catch (Exception $e) {
            alert()->error(__('backend.error'));
            return redirect(route('backend.team.index'));
        }
    }

    public function edit($id)
    {
        abort_if(Gate::denies('team edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $team = Team::findOrFail($id);
        return view('backend.team.update', get_defined_vars());
    }

    public function update(Request $request, Team $team)
    {
        abort_if(Gate::denies('team edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            DB::transaction(function () use ($request, $team) {
                if ($request->hasFile('image')) {
                    unlink((public_path($team->image)));
                    $team->image = upload('teams', $request->file('image'));
                }
                foreach (active_langs() as $lang) {
                    $team->translate($lang->code)->name = $request->name[$lang->code];
                    $team->translate($lang->code)->position = $request->position[$lang->code];
                    $team->translate($lang->code)->alt = $request->alt[$lang->code];
                }
                $team->save();
            });
            alert()->success(__('messages.success'));
            return redirect(route('backend.team.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.team.index'));
        }
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('team delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            unlink(team::find($id)->image);
            Team::find($id)->delete();
            alert()->success(__('messages.success'));
            return redirect()->route('backend.team.index');
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.team.index');
        }
    }
}
