<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SiteLanguage;
use App\Models\Slider;
use App\Models\SliderTranslation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class SliderController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('slider index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $sliders = Slider::latest()->get();
        return view('backend.slider.index', get_defined_vars());
    }

    public function create()
    {
        abort_if(Gate::denies('slider create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.slider.create');
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('slider create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $languages = SiteLanguage::where('status', 1)->get();
            $slider = new Slider();
            if (empty(Slider::first())) {
                $sliderOrder = 1;
            } else {
                $sliderOrder = Slider::all()->last()->order + 1;
            }
            $slider->image = upload('sliders', $request->file('image'));
            $slider->order = $sliderOrder;
            $slider->status = 1;
            $slider->save();
            foreach (active_langs() as $active_lang) {
                $translation = new SliderTranslation();
                $translation->title = $request->title[$active_lang->code];
                $translation->content = $request->content[$active_lang->code];
                $translation->alt = $request->alt[$active_lang->code];
                $translation->locale = $active_lang->code;
                $translation->slider_id = $slider->id;
                $translation->save();
            }
            alert()->success(__('messages.success'));
            return redirect(route('backend.slider.index'));
        } catch (Exception $e) {
            alert()->error(__('backend.error'));
            return redirect(route('backend.slider.index'));
        }
    }

    public function edit($id)
    {
        abort_if(Gate::denies('slider edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $slider = Slider::findOrFail($id);
        return view('backend.slider.update', get_defined_vars());
    }

    public function update(Request $request, Slider $slider)
    {
        abort_if(Gate::denies('slider edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            DB::transaction(function () use ($request, $slider) {
                if ($request->hasFile('image')) {
                    unlink((public_path($slider->image)));
                    $slider->image = upload('sliders', $request->file('image'));
                }
                foreach (active_langs() as $lang) {
                    $slider->translate($lang->code)->title = $request->title[$lang->code];
                    $slider->translate($lang->code)->content = $request->content[$lang->code];
                    $slider->translate($lang->code)->alt = $request->alt[$lang->code];
                }
                $slider->save();
            });
            alert()->success(__('messages.success'));
            return redirect(route('backend.slider.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.slider.index'));
        }
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('slider delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            unlink(Slider::find($id)->image);
            Slider::find($id)->delete();
            alert()->success(__('messages.success'));
            return redirect()->route('backend.slider.index');
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.slider.index');
        }
    }

    public function sliderOrder(Request $request, $id)
    {
        abort_if(Gate::denies('slider edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $slider = Slider::find($id);
            $orders = [];
            foreach (Slider::orderBy('order', 'asc')->get() as $sl) {
                $orders[] = $sl->order;
            }
            if ($request->direction == "up") {
                $prevKey = (array_search($slider->order, $orders)) - 1;
                Slider::where('order', $orders[$prevKey])->update([
                    'order' => $slider->order,
                ]);
                $slider->update(['order' => $orders[$prevKey]]);
            } else {
                if ($slider->order == end($orders)) {
                    Slider::where('order', $orders[count($orders) - 2])->update([
                        'order' => $slider->order
                    ]);
                    $slider->update(['order' => $orders[count($orders) - 2]]);
                } elseif ($slider->order == $orders[0]) {
                    Slider::where('order', $orders[1])->update([
                        'order' => $slider->order
                    ]);
                    $slider->update(['order' => $orders[1]]);
                } else {
                    $nextKey = (array_search($slider->order, $orders)) + 1;
                    Slider::where('order', $orders[$nextKey])->update([
                        'order' => $orders[$nextKey - 1],
                    ]);
                    $slider->update(['order' => $orders[$nextKey]]);
                }
            }
            return redirect(route('backend.slider.index'));
        } catch (Exception $e) {
            return redirect(route('backend.slider.index'));
        }
    }

    public function sliderStatus($id)
    {
        $status = Slider::where('id', $id)->value('status');
        if ($status == 1) {
            Slider::where('id', $id)->update(['status' => 0]);
        } else {
            Slider::where('id', $id)->update(['status' => 1]);
        }
        return redirect()->route('backend.slider.index');
    }

}
