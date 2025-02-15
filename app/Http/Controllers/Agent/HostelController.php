<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Http\Requests\HostelRequest;
use App\Models\Amenity;
use App\Models\City;
use App\Models\Hostel;
use App\Models\Image as ModelsImage;
use App\Models\Period;
use App\Models\Property;
use App\Models\Rule;
use App\Models\State;
use App\Models\Utility;
use Intervention\Image\ImageManagerStatic as Image;

class HostelController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Hostel::class, 'hostel');
    }

    public function index()
    {
        $hostels = Hostel::agent()->get();

        return view('agents.listing', compact('hostels'));
    }

    public function create(Hostel $hostel)
    {
        $states = State::get();
        $properties = Property::get();
        $amenities = Amenity::get();
        $utilities = Utility::get();
        $rules = Rule::get();
        $periods = Period::get();

        return view(
            'agents.hostels.create',
            compact('hostel', 'states', 'properties', 'amenities', 'utilities', 'rules', 'periods')
        );
    }

    public function store(HostelRequest $request)
    {
        // ? Add hostel to table, and populate other tables(hostel_utility, amenity_hostel, hostel_rule) with data
        if (auth('agent')->check()) {
//          $hostel = auth('agent')->user()->hostels()->create($request->validated());
            $hostel = auth('agent')->user()->hostels()->create([
                'hostel_name' => $request->hostel_name,
                'address' => $request->address,
                'state_id' => $request->state_id,
                'city_id' => $request->city_id,
                'property' => $request->property,
                'roomNum' => $request->roomNum,
                'amount' => $request->amount,
                'period' => $request->period,
                'tenantType' => $request->tenantType,
                'coverImage' => $this->_uploadCoverImage($request),
            ]);

            if ($request->hasFile('images')) {
                $this->_uploadImages($request, $hostel);
            }

            $hostel->amenities()->sync($request->amenities);
            $hostel->utilities()->sync($request->utilities);
            $hostel->rules()->sync($request->rules);

            notify()->preset('hostel-added');
            return redirect()->route('agent.hostels.index');
        }

        return redirect()->back()
            ->with('error', 'A problem occurred');
    }

    public function show($id)
    {
    }

    public function edit(Hostel $hostel)
    {
        $amenities = Amenity::get();
        $utilities = Utility::get();
        $rules = Rule::get();
        $properties = Property::get();
        $states = State::get();
        $cities = City::get();
        $periods = Period::get();

        return view(
            'agents.hostels.edit',
            compact('hostel', 'amenities', 'utilities', 'rules', 'properties', 'states', 'cities', 'periods')
        );
    }

    public function update(HostelRequest $request, Hostel $hostel)
    {
        $hostel->update([
            'hostel_name' => $request->hostel_name,
            'address' => $request->address,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'property' => $request->property,
            'roomNum' => $request->roomNum,
            'amount' => $request->amount,
            'period' => $request->period,
            'tenantType' => $request->tenantType,
        ]);

        if ($request->hasFile('coverImage')) {
//            unlink(storage_path('app/public/hostels/' . $hostel->coverImage));
            $this->_updateCoverImage($request, $hostel);
        }

        if ($request->hasFile('images')) {
            $this->_uploadImages($request, $hostel);
        }

        $hostel->amenities()->sync($request->amenities);
        $hostel->utilities()->sync($request->utilities);
        $hostel->rules()->sync($request->rules);

        notify()->preset('hostel-updated');
        return redirect()->route('agent.hostels.index');
    }

    //    public function destroy(Hostel $hostel)
    //    {
    //        $hostel->delete();
    //        notify()->preset('hostel-deleted');
    //        return redirect()->route('agent.hostels.index');
    //    }

    public function destroy(Hostel $hostel)
    {
        $deleteMultipleImages = ModelsImage::where('hostel_id', $hostel->id)->get();
        foreach ($deleteMultipleImages as $deleteMultipleImage) {
            unlink(storage_path('app/public/hostels/' . $deleteMultipleImage->image));
        }

        unlink(storage_path('app/public/hostels/' . $hostel->coverImage));
        $hostel->amenities()->detach($hostel->amenities);
        $hostel->utilities()->detach($hostel->utilities);
        $hostel->rules()->detach($hostel->rules);
        $hostel->forceDelete();
        notify()->preset('hostel-deleted');
        return redirect()->route('agent.hostels.index');
    }

    private function _uploadCoverImage($request)
    {
        $image = $request->file('coverImage');
        $name = $request->hostel_name;
        $filename = 'HP_H_' . $name . '.' . $image->getClientOriginalExtension();
        Image::make($image)->save(storage_path('app/public/hostels/' . $filename));

        return $filename;
    }

    private function _updateCoverImage($request, $hostel)
    {
        $image = $request->file('coverImage');
        $name = $request->hostel_name;
        $filename = 'HP_H_' . $name . '.' . $image->getClientOriginalExtension();
        Image::make($image)->save(storage_path('app/public/hostels/' . $filename));

        $hostel->coverImage = $filename;
        $hostel->save();
    }

    private function _uploadImages($request, $hostel)
    {
        $images = $request->file('images');
        $name = $request->hostel_name;
        $i = 1;
        foreach ($images as $image) {
            $filename = 'HP_H_' . $name . $i++ . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 250)
                ->save(storage_path('app/public/hostels/' . $filename));
//            resize(300, null, function ($constraint) {
//                $constraint->aspectRatio();
//            })
            //            $hostel->image = $filename;
            $hostel->images()->create(['image' => $filename]);
            $hostel->save();
        }
    }
}
