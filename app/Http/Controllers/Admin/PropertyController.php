<?php

namespace Laradev\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Laradev\Http\Controllers\Controller;
use Laradev\Http\Requests\Admin\Property as PropertyRequest;
use Laradev\Property;
use Laradev\PropertyImage;
use Laradev\User;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties = Property::orderBy('id','DESC')->get();
        return view('admin.properties.index',[
            'properties' => $properties
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::orderBy('name')->get();
        return view('admin.properties.create',[
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropertyRequest $request)
    {
        $createProperty = Property::create($request->all());

        if($request->allFiles()){
            foreach ($request->allFiles()['files'] as $image) {
                $propertyImage = new PropertyImage();
                $propertyImage->property = $createProperty->id;
                $propertyImage->path = $image->storeAs('properties/' . $createProperty->id, str_slug($request->title) . '-' . str_replace('.', '', microtime(true)) . '.' . $image->extension());
                $propertyImage->save();
                unset($propertyImage);
            }
        }
        
        return redirect()->route('admin.properties.edit',[
            'property' => $createProperty->id
        ])->with(['color' => 'green', 'message' => 'Imóvel cadastrado com sucesso!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $property = Property::where('id',$id)->first();
        $users = User::orderBy('name')->get();
        return view('admin.properties.edit',[
            'property' => $property,
            'users' => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PropertyRequest $request, $id)
    {
        $property = Property::where('id',$id)->first();
        $property->fill($request->all());//Dessa forma caso não informe nenhum checkbox não estará vindo aqui pra dentro não alterando o dado no banco de dados

        $property->setSaleAttribute($request->sale);
        $property->setRentAttribute($request->rent);
        $property->setAirConditioningAttribute($request->air_conditioning);
        $property->setBarAttribute($request->bar);
        $property->setLibraryAttribute($request->library);
        $property->setBarbecueGrillAttribute($request->barbecue_grill);
        $property->setAmericanKitchenAttribute($request->american_kitchen);
        $property->setFittedKitchenAttribute($request->fitted_kitchen);
        $property->setPantryAttribute($request->pantry);
        $property->setEdiculeAttribute($request->edicule);
        $property->setOfficeAttribute($request->office);
        $property->setBathtubAttribute($request->bathtub);
        $property->setFirePlaceAttribute($request->fireplace);
        $property->setLavatoryAttribute($request->lavatory);
        $property->setFurnishedAttribute($request->furnished);
        $property->setPoolAttribute($request->pool);
        $property->setSteamRoomAttribute($request->steam_room);
        $property->setViewOfTheSeaAttribute($request->view_of_the_sea);

        $property->save();

        if($request->allFiles()){
            foreach ($request->allFiles()['files'] as $image) {
                $propertyImage = new PropertyImage();
                $propertyImage->property = $property->id;
                $propertyImage->path = $image->storeAs('properties/' . $property->id, str_slug($request->title) . '-' . str_replace('.', '', microtime(true)) . '.' . $image->extension());
                $propertyImage->save();
                unset($propertyImage);
            }
        }

        return redirect()->route('admin.properties.edit',[
            'property' => $property->id
        ])->with(['color' => 'green', 'message' => 'Imóvel alterado com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function imageSetCover(Request $request)
    {
        
        $imageSetCover = PropertyImage::where('id',$request->image)->first();//Busca a imagem completa(objeto)
        $allImage = PropertyImage::where('property',$imageSetCover->property)->get();//Busca todas as imagens do imóvel
        foreach ($allImage as $image) {
            $image->cover = null;//Tornando todas as capas das imagens como null
            $image->save();
        }
        $imageSetCover->cover = true;//Setando a imagem como capa(cover) do imóvel(property)
        $imageSetCover->save();

        $json = [
            'success' => true
        ];

        return response()->json($json);
    }
    
    public function imageRemove()
    {
        return response()->json('Você chegou até o php e conseguiu retornar os dados de remove');
    }
}
