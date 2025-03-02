<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
namespace App\Models;
    use CodeIgniter\Model;

class ResetlinkModel extends Model
    {        
        protected $table = 'resetlink';
        protected $primaryKey = 'resetid';
        protected $allowedFields=['resetuserid','key','dt_ins'];

        
    }