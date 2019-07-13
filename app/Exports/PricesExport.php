<?php

namespace App\Exports;

use App\Price;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PricesExport implements FromCollection, WithHeadings, WithMapping
{   
	private $itemId;
	private $startDate;
	private $endDate;

	public function __construct($itemId, $startDate, $endDate)
	{
		$this->itemId = $itemId;
		$this->startDate = $startDate;
		$this->endDate = $endDate;
	}

    public function headings(): array
    {
    	//Pone titulos a las columnas
        return [
            'UBICACION',
            'ITEM',
            'USUARIO',
            'VALOR CARGADO',
            'FECHA DE REGISTRO'
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return Price::all();
        //with carga prices, con las locations, items y users asociados
        return Price::with('location', 'item', 'user')
        		->whereBetween('created_at', [$this->startDate, $this->endDate])
        		->where('item_id', $this->itemId)
        		->get([
			        	'location_id',
			        	'item_id',
			        	'user_id',
			        	'value',
			        	'created_at'
			        ]);
    }

    /**
    * @var Price $price
    */
    public function map($price): array
    {
    	//Mapea los campos de la tabla prices con las tablas con que se relaciona
        return [
        	$price->location->name,
        	$price->item->name,
        	$price->user->name,
            $price->value,
            $price->created_at
        ];
    }    
}
