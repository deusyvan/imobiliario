<?php

namespace Laradev;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Laradev\Support\Cropper;

class Property extends Model
{
    protected $fillable = [
        'sale',
        'rent',
        'category',
        'type',
        'user',
        'sale_price',
        'rent_price',
        'tribute',
        'condominium',
        'description',
        'bedrooms',
        'suites',
        'bathrooms',
        'rooms',
        'garage',
        'garage_covered',
        'area_total',
        'area_util',
        'zipcode',
        'street',
        'number',
        'complement',
        'neighborhood',
        'state',
        'city',
        'air_conditioning',
        'bar',
        'library',
        'barbecue_grill',
        'american_kitchen',
        'fitted_kitchen',
        'pantry',
        'edicule',
        'office',
        'bathtub',
        'fireplace',
        'lavatory',
        'furnished',
        'pool',
        'steam_room',
        'view_of_the_sea'
    ];

    /** Relacionamento */
    public function user()//Singular porque o imóvel só pode ter um único dono
    {
        /** Relacionamento (1:N)
         * Chave estrangeira = user (dentro da tabela de imóveis qual se relaciona com o usuário)
         * Chave local = id (chave dentro da tabela de usuário)
        */
        return $this->belongsTo(User::class,'user','id'); //belongsTo devolve apenas um único registro
    }

    public function images()
    {
        //Buscando as imagens de acordo com o relacionamento 1:N (1-imóvel : N-imagens) Tabela Properties possui a chave estrangeira: property que relaciona com o id do modelo
        return $this->hasMany(PropertyImage::class, 'property','id')->orderBy('cover','ASC');
    }

    public function cover()
    {
        $images = $this->images();//Busca todas a imagens do referido imvóvel
        $cover = $images->where('cover',1)->first(['path']);//Nas imagens busca apenas aquela que é a capa e somente a coluna path
        if(!$cover){
            $images = $this->images();//Caso não tenha busca as imagens do imóvel
            $cover = $images->first(['path']);//Não havendo nenhuma como cover define a primeira na busca
        }

        //Caso não exista nenhuma imagem mostre a padrão
        if(empty($cover['path']) || !File::exists('../public/storage/' . $cover['path'])){
            return url(asset('backend/assets/images/realty.jpeg'));//Url completa para a padrão
        }
        return Storage::url(Cropper::thumb($cover['path'],1366,768));//retorna cover no índice path convertida em uma url
    }

    public function setSaleAttribute($value)
    {
        $this->attributes['sale'] = ($value == true || $value == 'on' ? 1 : 0);
    }

    public function setRentAttribute($value)
    {
        $this->attributes['rent'] = ($value == true || $value == 'on' ? 1 : 0);
    }

    public function setSalePriceAttribute($value)
    {
        if(empty($value)){
            $this->attributes['sale_price'] = null;
        }else{
            $this->attributes['sale_price'] = floatval($this->convertStringToDouble($value));
        }
    }

    public function getSalePriceAttribute($value)
    {
        return number_format($value,2,',','.');
    }

    public function setRentPriceAttribute($value)
    {
        if(empty($value)){
            $this->attributes['rent_price'] = null;
        }else{
            $this->attributes['rent_price'] = floatval($this->convertStringToDouble($value));
        }
    }

    public function getRentPriceAttribute($value)
    {
        return number_format($value,2,',','.');
    }

    public function setTributeAttribute($value)
    {
        if(empty($value)){
            $this->attributes['tribute'] = null;
        }else{
            $this->attributes['tribute'] = floatval($this->convertStringToDouble($value));
        }
    }

    public function getTributeAttribute($value)
    {
        return number_format($value,2,',','.');
    }

    public function setCondominiumAttribute($value)
    {
        if(empty($value)){
            $this->attributes['condominium'] = null;
        }else{
            $this->attributes['condominium'] = floatval($this->convertStringToDouble($value));
        }
    }
    
    /**Mutator */

    public function getCondominiumAttribute($value)
    {
        return number_format($value,2,',','.');
    }

    public function setAirConditioningAttribute($value)
    {
        $this->attributes['air_conditioning'] = ($value == true || $value == 'on' ? 1 : 0);
    }

    public function setBarAttribute($value)
    {
        $this->attributes['bar'] = ($value == true || $value == 'on' ? 1 : 0);
    }

    public function setLibraryAttribute($value)
    {
        $this->attributes['library'] = ($value == true || $value == 'on' ? 1 : 0);
    }

    public function setBarbecueGrillAttribute($value)
    {
        $this->attributes['barbecue_grill'] = ($value == true || $value == 'on' ? 1 : 0);
    }

    public function setAmericanKitchenAttribute($value)
    {
        $this->attributes['american_kitchen'] = ($value == true || $value == 'on' ? 1 : 0);
    }

    public function setFittedKitchenAttribute($value)
    {
        $this->attributes['fitted_kitchen'] = ($value == true || $value == 'on' ? 1 : 0);
    }

    public function setPantryAttribute($value)
    {
        $this->attributes['pantry'] = ($value == true || $value == 'on' ? 1 : 0);
    }

    public function setEdiculeAttribute($value)
    {
        $this->attributes['edicule'] = ($value == true || $value == 'on' ? 1 : 0);
    }

    public function setOfficeAttribute($value)
    {
        $this->attributes['office'] = ($value == true || $value == 'on' ? 1 : 0);
    }

    public function setBathtubAttribute($value)
    {
        $this->attributes['bathtub'] = ($value == true || $value == 'on' ? 1 : 0);
    }

    public function setFireplaceAttribute($value)
    {
        $this->attributes['fireplace'] = ($value == true || $value == 'on' ? 1 : 0);
    }

    public function setLavatoryAttribute($value)
    {
        $this->attributes['lavatory'] = ($value == true || $value == 'on' ? 1 : 0);
    }

    public function setFurnishedAttribute($value)
    {
        $this->attributes['furnished'] = ($value == true || $value == 'on' ? 1 : 0);
    }

    public function setPoolAttribute($value)
    {
        $this->attributes['pool'] = ($value == true || $value == 'on' ? 1 : 0);
    }

    public function setSteamRoomAttribute($value)
    {
        $this->attributes['steam_room'] = ($value == true || $value == 'on' ? 1 : 0);
    }

    public function setViewOfTheSeaAttribute($value)
    {
        $this->attributes['view_of_the_sea'] = ($value == true || $value == 'on' ? 1 : 0);
    }

    private function convertStringToDouble($param)
    {
        if(empty($param)){
            return null;
        }
        return str_replace(',','.',str_replace('.','',$param));
    }
}
