<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\PortfolioTranslation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class PortfolioController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('portfolio index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $portfolios = Portfolio::latest()->get();
        return view('backend.portfolio.index', get_defined_vars());
    }

    public function create()
    {
        abort_if(Gate::denies('portfolio create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.portfolio.create');
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('portfolio create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        /* try { */
            $portfolio = new Portfolio();
            $portfolio->image = upload('portfolios', $request->file('image'));
            $portfolio->link = $request->link;
            $portfolio->save();
            foreach (active_langs() as $active_lang) {
                $translation = new PortfolioTranslation();
                $translation->title = $request->title[$active_lang->code];
                $translation->content = $request->content[$active_lang->code];
                $translation->alt = $request->alt[$active_lang->code];
                $translation->locale = $active_lang->code;
                $translation->portfolio_id = $portfolio->id;
                $translation->save();
            }
            alert()->success(__('messages.success'));
            return redirect(route('backend.portfolio.index'));
        /* } catch (Exception $e) {
            alert()->error(__('backend.error'));
            return redirect(route('backend.portfolio.index'));
        } */
    }

    public function edit($id)
    {
        abort_if(Gate::denies('portfolio edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $portfolio = Portfolio::findOrFail($id);
        return view('backend.portfolio.update', get_defined_vars());
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        abort_if(Gate::denies('portfolio edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            DB::transaction(function () use ($request, $portfolio) {
                if ($request->hasFile('image')) {
                    if(file_exists($portfolio->image)){
                         unlink((public_path($portfolio->image)));
                    }
                    $portfolio->image = upload('portfolios', $request->file('image'));
                    $portfolio->link =  $request->link;
                }
                foreach (active_langs() as $lang) {
                    $portfolio->translate($lang->code)->title = $request->title[$lang->code];
                    $portfolio->translate($lang->code)->content = $request->content[$lang->code];
                    $portfolio->translate($lang->code)->alt = $request->alt[$lang->code];
                }
                $portfolio->save();
            });
            alert()->success(__('messages.success'));
            return redirect(route('backend.portfolio.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.portfolio.index'));
        }
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('portfolio delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            unlink(Portfolio::find($id)->image);
            Portfolio::find($id)->delete();
            alert()->success(__('messages.success'));
            return redirect()->route('backend.portfolio.index');
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.portfolio.index');
        }
    }
}
