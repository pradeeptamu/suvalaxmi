<?php

namespace App\Http\Controllers\API;

use App\Models\ApartmentHouse;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $property = DB::table('properties')
            ->leftJoin('apartment_house', 'apartment_house.property_id', '=', 'properties.id')
            ->select('apartment_house.*', 'properties.*')
            ->latest('properties.created_at')
            ->paginate(6);

        $property->each(function ($value) {
            $value->time = \Carbon\Carbon::parse($value->created_at)->diffForHumans();
            unset($value->created_at);
        });

        return $property;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        if ($request['category'] === 'apartment' || $request['category'] === 'house') {
//            $request->validate([
//                'built_year' => 'numeric',
//                'floors' => 'numeric|max:100',
//                'furnish_status' => 'required|string|max:50',
//                'kitchen' => 'numeric|max:100',
//                'bedroom' => 'numeric|max:100',
//                'bathroom' => 'numeric|max:100',
//                'living_room' => 'numeric|max:100',
//                'parking' => 'numeric|max:100',
//            ]);
//        }
        $request->validate([
            'owner_id' => 'required',
            'address' => 'required|max:100',
            'location' => 'required|string|max:100',
            'area_total' => 'required|numeric|min:1',
//            'area_built' => 'required|numeric|min:1',
            'face' => 'required|string',
            'road_size' => 'required|numeric|min:1',
            'road_type' => 'required|string|max:50',
            'price' => 'required|numeric|min:1',
//            'price_unit' => 'required|string',
            'title' => 'required|string|max:100',
            'description' => 'required|string',
            'images' => 'required',
//            'images.*' => 'image|mimes:jpeg,png,JPG|max:2048'
        ]);

//        dd($request);
        //image
        $name = "";
        $temp = [];
        $thumbnail = '';
        foreach ($request->images as $key => $value) {
            $name = md5(microtime()) . '.' . explode('/', explode(':', substr($value, 0, strpos($value, ';')))[1])[1];
            array_push($temp, $name);
            //laravel intervention to convert base 64 image and save to profile
            \Image::make($value)->save(public_path('img/property/') . $name);
            //for thumbnail..saving first image
            if ($key == 0) {
                \Image::make($value)->fit(324, 197)->save(public_path('img/thumbnail/') . $name);
                $thumbnail = $name;
            }
        }
        $img = [];
        foreach ($temp as $key => $value) {
            $img[$key] = $temp[$key];
        }
        $val = implode(",", $img);

        $latest = Property::create([
            'owner_id' => $request['owner_id'],
            'address' => $request['address'],
            'category' => $request['category'],
            'purpose' => $request['purpose'],
            'type' => $request['type'],
            'location' => $request['location'],
            'area_total' => $request['area_total'],
            'area_built' => $request['area_built'],
            'face' => $request['face'],
            'road_size' => $request['road_size'],
            'road_type' => $request['road_type'],
            'price' => $request['price'],
            'price_unit' => $request['price_unit'],
            'title' => $request['title'],
            'description' => $request['description'],
            'images' => $val,
            'thumbnail' => $thumbnail
        ]);
        $house_apar = '';
        if ($request['category'] === 'apartment' || $request['category'] === 'house') {
            $house_apar = Apartment_House::create([
                'built_year' => $request['built_year'],
                'property_id' => $latest->id,
                'no_floors' => $request['floors'],
                'furnish_status' => $request['furnish_status'],
                'kitchen' => $request['kitchen'],
                'bedroom' => $request['bedroom'],
                'bathroom' => $request['bathroom'],
                'living_room' => $request['living_room'],
                'parking' => $request['parking'],
                'amenities' => implode(",", $request['amenities']),
            ]);
        }
        return response()->json([$house_apar, $latest]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Property::where('id', $id)->first();
    }

    public function changeStatus($id, $value)
    {
        $prop = Property::findOrFail($id);
        $prop->status = $value;
        $prop->save();
        return response()->json(['Success']);
    }


    public function getPropertyByUserId($id)
    {
        return Property::where('owner_id', '=', $id)->paginate(5);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $prop = Property::findOrFail($id);
        $propAlt = Property::findOrFail($id)->apartment_house;
        if (!empty($propAlt) && $request['category'] === 'land') {
            $propAlt->delete();
        }
        if ($request['category'] === 'apartment' || $request['category'] === 'house') {
//            $request->validate([
//                'built_year' => 'required|numeric',
//                'floors' => 'required|numeric|max:100|min:1',
//                'furnish_status' => 'required|string|max:50|min:5',
//                'kitchen' => 'required|numeric|max:100|min:1',
//                'bedroom' => 'required|numeric|max:100|min:1',
//                'bathroom' => 'required|numeric|max:100|min:1',
//                'living_room' => 'required|numeric|max:100|min:1',
//                'parking' => 'required|numeric|max:100|min:1',
//            ]);
            if (empty($propAlt)) {
                Apartment_House::create([
                    'built_year' => $request['built_year'],
                    'property_id' => $prop->id,
                    'no_floors' => $request['floors'],
                    'furnish_status' => $request['furnish_status'],
                    'kitchen' => $request['kitchen'],
                    'bedroom' => $request['bedroom'],
                    'bathroom' => $request['bathroom'],
                    'living_room' => $request['living_room'],
                    'parking' => $request['parking'],
                    'amenities' => implode(",", $request['amenities'])
                ]);
            } else {
                $request->merge(['amenities' => implode(",", $request->amenities)]);
                $propAlt->update($request->all());
            }
        }

        $request->validate([
            'owner_id' => 'required',
            'address' => 'required|max:100',
            'location' => 'required|string|max:100',
            'area_total' => 'required|numeric|min:1',
//            'area_built' => 'required|numeric|min:1',
            'face' => 'required|string',
            'road_size' => 'required|numeric|min:1',
            'road_type' => 'required|string|max:50',
            'price' => 'required|numeric|min:1',
//            'price_unit' => 'required|string',
            'title' => 'required|string|max:100',
            'description' => 'required|string',
            'images' => 'required',
//            'images.*' => 'image|mimes:jpeg,png,JPG|max:2048'
        ]);
        $thumbnail = "";
        //checking old photo or new photo
        //if new photo then save new and delete old one
        if (is_array($request->images)) {
            $name = "";
            $temp = [];
            foreach ($request->images as $key => $value) {
                $name = md5(microtime()) . '.' . explode('/', explode(':', substr($value, 0, strpos($value, ';')))[1])[1];
                array_push($temp, $name);
                //laravel intervention to convert base 64 image and save to profile
                \Image::make($value)->save(public_path('img/property/') . $name);
                if ($key == 0) {
                    \Image::make($value)->fit(324, 197)->save(public_path('img/thumbnail/') . $name);
                    $thumbnail = $name;
                }
            }
            $img = [];
            foreach ($temp as $key => $value) {
                $img[$key] = $temp[$key];
            }
            $val = implode(",", $img);
            $request->merge(['images' => $val]);
            $request->merge(['thumbnail' => $thumbnail]);

            //deleting old image
            $imgArr = explode(",", $prop->images);
            foreach ($imgArr as $key => $value) {
                $image_path = public_path("img/property/" . $value);  // Value is not URL but directory file path
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
                //deleting thumbnail
                $path = public_path("img/thumbnail/" . $value);
                if ($key == 0) {
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                }
            }

        }
        //sometimes only validate the field if the field is present
        $prop->update($request->all());
        return ['message' => 'Updated the Property info'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $property = Property::findOrFail($id);
        $imgArr = explode(",", $property->images);
        foreach ($imgArr as $key => $value) {
            $image_path = public_path("img/property/" . $value);  // Value is not URL but directory file path
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            $path = public_path("img/thumbnail/" . $value);
            if ($key == 0) {
                if (File::exists($path)) {
                    File::delete($path);
                }
            }
        }
        $property->delete();
        return ['message' => 'Property Deleted'];
    }

    public function getHouse($id)
    {
        $house = Apartment_House::where('property_id', $id)->first();
        return response()->json([$house]);
    }

    public function getFilter($filter)
    {
        $query = DB::table('properties')
            ->leftJoin('apartment_house', 'apartment_house.property_id', '=', 'properties.id')
            ->select('apartment_house.*', 'properties.*');
            // return $filter;

        foreach (json_decode($filter) as $column => $value) {
            if ($column == 'price') {
                $query->where($column, '<=', $value);
            } elseif ($column == 'sort') {
                switch ($value) {
                    case 'high':
                        $query->orderBy('price', 'desc')->get();
                        break;
                    case 'low':
                        $query->orderBy('price', 'asc')->get();
                        break;
                    case 'latest':
                        $query->latest('properties.created_at');
                        break;
                    case 'oldest':
                        $query->oldest('properties.created_at');
                        break;
                }
            } else {
                $query->where($column, '=', $value);
            }
        }

        $val = $query->paginate(6);

        $val->each(function ($value) {
            $value->time = \Carbon\Carbon::parse($value->created_at)->diffForHumans();
            unset($value->created_at);
        });

        return response()->json($val);

    }

    public function search()
    {
        if ($search = \Request::get('q')) {
            $users = Property::where(function ($query) use ($search) {
                $query->where('purpose', 'LIKE', "%$search%")
                    ->orWhere('location', 'LIKE', "%$search%")
                    ->orWhere('type', 'LIKE', "%$search%")
                    ->orWhere('category', 'LIKE', "%$search%")
                    ->orWhere('price', 'LIKE', "%$search%");
            })->paginate(20);
        } else {
            $users = Property::latest()->paginate(5);
        }
        return $users;
    }

    public function similarProperty($category, $id)
    {
        $property = Property::where('category', '=', $category)
            ->where('id', '!=', $id)
            ->take(3)
            ->get();

        $property->each(function ($value) {
            $value->time = \Carbon\Carbon::parse($value->created_at)->diffForHumans();
            unset($value->created_at);
        });
        return $property;
    }

    public function singleProperty($id)
    {
        $property = Property::findOrFail($id);
        if ($property->category != 'land') {
            $property = DB::table('apartment_house')
                ->join('properties', 'apartment_house.property_id', '=', 'properties.id')
                ->join('users', 'properties.owner_id', '=', 'users.id')
                ->select('apartment_house.id as aid', 'apartment_house.*', 'users.name as owner_name', 'users.address as owner_address', 'users.phone as owner_phone', 'users.photo as owner_photo', 'properties.*')
                ->where('properties.id', '=', $id)
                ->first();
            return json_encode($property);
        } else {
            $property = DB::table('properties')
                ->join('users', 'properties.owner_id', '=', 'users.id')
                ->select('users.name as owner_name', 'users.address as owner_address', 'users.phone as owner_phone', 'users.photo as owner_photo', 'properties.*')
                ->where('properties.id', '=', $id)
                ->first();
            return json_encode($property);
        }

        return $property;
    }

    public function getLatestProperty()
    {
        $land = Property::where('category', '=', 'land')
            ->select('id', 'title', 'thumbnail', 'purpose', 'views', 'address', 'location', 'category', 'price', 'price_unit', 'created_at')
            ->latest()->take(6)->get();
        $house = DB::table('properties')
            ->join('apartment_house', 'apartment_house.property_id', '=', 'properties.id')
            ->where('properties.category', '=', 'house')
            ->latest('properties.created_at')
            ->select('properties.id', 'properties.thumbnail', 'properties.purpose', 'properties.views', 'properties.title',
                'properties.address', 'properties.location', 'properties.category', 'properties.price', 'properties.price_unit',
                'properties.created_at', 'apartment_house.bedroom', 'apartment_house.bathroom')
            ->take(6)
            ->get();


        $apartment = DB::table('properties')
            ->join('apartment_house', 'apartment_house.property_id', '=', 'properties.id')
            ->where('properties.category', '=', 'apartment')
            ->latest('properties.created_at')
            ->select('properties.id', 'properties.thumbnail', 'properties.purpose', 'properties.views', 'properties.title',
                'properties.address', 'properties.location', 'properties.category', 'properties.price', 'properties.price_unit',
                'properties.created_at', 'apartment_house.bedroom', 'apartment_house.bathroom')
            ->take(6)
            ->get();
    //    $house = Property::where('category', '=', 'house')->latest('properties.created_at')->join('apartment_house', 'apartment_house.property_id', '=', 'properties.id')->take(6)->get();
    //    $apartment = Property::where('category', '=', 'apartment')->latest('properties.created_at')->join('apartment_house', 'apartment_house.property_id', '=', 'properties.id')->take(6)->get();

        $house->each(function ($value) {
            $value->time = \Carbon\Carbon::parse($value->created_at)->diffForHumans();
            unset($value->created_at);
        });
        $land->each(function ($value) {
            $value->time = \Carbon\Carbon::parse($value->created_at)->diffForHumans();
            unset($value->created_at);
        });
        $apartment->each(function ($value) {
            $value->time = \Carbon\Carbon::parse($value->created_at)->diffForHumans();
            unset($value->created_at);
        });
        return [$land, $house, $apartment];
    }

    public function getViews($id)
    {
        $view = Property::find($id);
        $view->views = $view->views + 1;
        $view->save();
    }

    public function getTrending()
    {
        $trending = DB::table('properties')
            ->leftJoin('apartment_house', 'apartment_house.property_id', '=', 'properties.id')
            ->select('properties.id', 'properties.thumbnail', 'properties.purpose', 'properties.views', 'properties.title',
                'properties.address', 'properties.location', 'properties.category', 'properties.price', 'properties.price_unit',
                'properties.created_at', 'apartment_house.bedroom', 'apartment_house.bathroom')
            ->orderBy('views', 'DESC')->take(6)->get();

        $trending->each(function ($value) {
            $value->time = \Carbon\Carbon::parse($value->created_at)->diffForHumans();
            unset($value->created_at);
        });
        return json_encode($trending);
    }
}
