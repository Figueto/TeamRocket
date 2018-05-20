<?php

use Illuminate\Database\Seeder;

class AjoutDefaultGenre extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array();
     	$data[] = array('nom'=>'Action');
     	$data[] = array('nom'=>'Animation');
     	$data[] = array('nom'=>'Aventure');
     	$data[] = array('nom'=>'Biographique');
     	$data[] = array('nom'=>'Catastrophe');
     	$data[] = array('nom'=>'Comédie');
     	$data[] = array('nom'=>'Comédie Dramatique'); 
     	$data[] = array('nom'=>'Comédie Musicale'); 
     	$data[] = array('nom'=>'Comédie Policière'); 
     	$data[] = array('nom'=>'Comédie Romantique'); 
     	$data[] = array('nom'=>'Court Métrage'); 
     	$data[] = array('nom'=>'Dessin Animé');  
     	$data[] = array('nom'=>'Documentaire');  
     	$data[] = array('nom'=>'Drame');   
     	$data[] = array('nom'=>'Drame Psychologique');   
     	$data[] = array('nom'=>'Epouvante');   
     	$data[] = array('nom'=>'Erotique');   
     	$data[] = array('nom'=>'Essai');   
     	$data[] = array('nom'=>'Humoristique');   
     	$data[] = array('nom'=>'Film Musical');    
     	$data[] = array('nom'=>'Guerre');    
     	$data[] = array('nom'=>'Historique');     
     	$data[] = array('nom'=>'Horreur');     
     	$data[] = array('nom'=>'Karaté');           
     	$data[] = array('nom'=>'Policier');           
     	$data[] = array('nom'=>'Politique');            
     	$data[] = array('nom'=>'Programme');            
     	$data[] = array('nom'=>'Romance');             
     	$data[] = array('nom'=>'Science Fiction');             
     	$data[] = array('nom'=>'Sérial');             
     	$data[] = array('nom'=>'Spectacle');              
     	$data[] = array('nom'=>'Téléfilm');              
     	$data[] = array('nom'=>'Théâtre');              
     	$data[] = array('nom'=>'Thriller');              
     	$data[] = array('nom'=>'Western');              
 		
 		DB::table('genre')->insert($data); 
    }
}
