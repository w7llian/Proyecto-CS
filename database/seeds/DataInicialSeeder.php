<?php

use Illuminate\Database\Seeder;

use App\Models\Alumno;
use App\Models\Profesor;
use App\User;
use App\Models\Salon;
use Illuminate\Support\Facades\Hash;

class DataInicialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $this->inicializarUsuarios("Kristian","Ccahui Huaman","kccahui@unsa.edu.pe");
        $this->inicializarUsuarios("Raul Rene","Laura Anccasi","rlauraa@unsa.edu.pe");
        $this->inicializarUsuarios("Willian","Orihuela Trujillo","worihuela@unsa.edu.pe");
        $this->inicializarUsuarios("Diego","Kari Ninacansaya","dkari@unsa.edu.pe");
        $this->inicializarUsuarios("Admin","Admin Example","frodo7495@gmail.com");

    }
    private function inicializarUsuarios($nombre, $apellido, $gmail){
        
        $this->factoryAlumno($nombre, $apellido, $gmail);
        $this->factoryProfesor($nombre, $apellido, $gmail);
        $this->factoryAdmin($nombre, $apellido, $gmail);

    }
    private function factoryAlumno($nombre, $apellido, $gmail){
        $salon = Salon::all()->first();
        $alumno = Alumno::create([
            'nombre' => $nombre,
            'apellido' => $apellido,
            'salon_id'=>$salon->id,
            'gmail'=>$gmail
        ]);
        Alumno::matricular($alumno);
    }
    private function factoryProfesor($nombre, $apellido, $gmail){
       
        $password = 1234;
        Profesor::create([
            'nombre' => $nombre,
            'apellido' => $apellido,
            'gmail'=>$gmail,
            'password'=>Hash::make($password),
        ]);
    }
    private function factoryAdmin($nombre, $apellido, $gmail){
        $nombre_completo = $nombre." ".$apellido; 
        factory(User::class)->create([
            'name'=>$nombre_completo,
            'email'=>$gmail
        ]);
    }
}
