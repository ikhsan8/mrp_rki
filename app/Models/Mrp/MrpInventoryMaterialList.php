<?php

namespace App\Models\Mrp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MrpInventoryMaterialList extends Model
{
    use HasFactory;

    protected $table = 'mrp_inventory_material_list';

    protected $guarded = [];

    public function material()
    {
        return $this->belongsTo(MrpMaterial::class, 'material_id');
    }

    public function materialSortir()
    {
        return $this->hasMany(MrpMaterialSortir::class, 'inventory_material_list_id');
    }
    public function materialSortirOK()
    {
        return $this->hasMany(MrpMaterialSortirOK::class, 'inventory_material_list_id');
    }
    public function materialSortirNG()
    {
        return $this->hasMany(MrpMaterialSortirNG::class, 'inventory_material_list_id');
    }
    
    public function inventoryMaterialIncomings()
    {
        return $this->hasMany(MrpInventoryMaterialIncoming::class, 'material_id');
    }
    public function inventoryMaterialOuts()
    {
        return $this->hasMany(MrpInventoryMaterialOut::class, 'inventory_material_list_id');
    }

    public function bom()
    {
        return $this->belongsTo(MrpBom::class);
    }

        public function materialUnits(){
    //Mengambil data  pivot unit
        $data = collect(DB::select('select * from mrp_bom_materials where bom_id = :bom_id', ['bom_id' => $this->id]))->map(function ($value) {
            $data['inventory_material'] = MrpInventoryMaterialList::findOrFail($value->material_id)->material->material_name;
            $data['unit'] = MrpUnit::find($value->unit_id)->unit_name ?? 'N/A';
            $data['qty_material'] = $value->qty_material ?? '';
            return $data;
        });
        return $data;
    }

    public function totalStock() {
        $data = MrpInventoryMaterialList::where('id' ,$this->id)->first();
        if ($data->total_target_day == 0) {
            return 0;
        }
        return floor($data->stock / $data->total_target_day);
    }
}
