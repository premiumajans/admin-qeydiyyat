<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogTranslation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('blog index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $blogs = BLog::latest()->get();
        return view('backend.blog.index', get_defined_vars());
    }

    public function create()
    {
        abort_if(Gate::denies('blog create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.blog.create');
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('blog create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $blog = new Blog();
            $blog->image = upload('blogs', $request->file('image'));
            $blog->save();
            foreach (active_langs() as $active_lang) {
                $translation = new BlogTranslation();
                $translation->title = $request->title[$active_lang->code];
                $translation->content = $request->content[$active_lang->code];
                $translation->slug = $request->slug[$active_lang->code];
                $translation->alt = $request->alt[$active_lang->code];
                $translation->locale = $active_lang->code;
                $translation->blog_id = $blog->id;
                $translation->save();
            }
            alert()->success(__('messages.success'));
            return redirect(route('backend.blog.index'));
        } catch (Exception $e) {
            alert()->error(__('backend.error'));
            return redirect(route('backend.blog.index'));
        }
    }

    public function edit($id)
    {
        abort_if(Gate::denies('blog edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $blog = Blog::findOrFail($id);
        return view('backend.blog.update', get_defined_vars());
    }

    public function update(Request $request, Blog $blog)
    {
        abort_if(Gate::denies('blog edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            DB::transaction(function () use ($request, $blog) {
                if ($request->hasFile('image')) {
                    unlink((public_path($blog->image)));
                    $blog->image = upload('blogs', $request->file('image'));
                }
                foreach (active_langs() as $lang) {
                    $blog->translate($lang->code)->title = $request->title[$lang->code];
                    $blog->translate($lang->code)->content = $request->content[$lang->code];
                    $blog->translate($lang->slug)->content = $request->slug[$lang->code];
                    $blog->translate($lang->code)->alt = $request->alt[$lang->code];
                }
                $blog->save();
            });
            alert()->success(__('messages.success'));
            return redirect(route('backend.blog.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.blog.index'));
        }
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('blog delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            unlink(Blog::find($id)->image);
            Blog::find($id)->delete();
            alert()->success(__('messages.success'));
            return redirect()->route('backend.blog.index');
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.blog.index');
        }
    }
}
