<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColectingForm extends Model
{
    use HasFactory;

    public function render()
    {
        $form = "";
        switch ($this->column_type) {
            case 'multiline':
                $form .= "<textarea required class='form-control' rows='5' name=".$this->id." ></textarea>";
                break;
            
            default:
                $form .= "<input type='".$this->column_type."' required class='form-control' name=".$this->id." />";
                break;
        }
        return '<div class="form-group"><label>'.$this->column_name.'</label>'.$form.'</div>';
    }
}
