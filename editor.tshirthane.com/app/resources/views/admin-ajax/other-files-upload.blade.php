<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Contents;

use Illuminate\Support\Facades\DB;

		$post = $_POST;

        $post['slug'] = $post['id'];

		

		$path = upload("file",$post['id']."/",rand());

		$path = str_replace("files/","",$path);

		$files_path = ("storage/app/files/{$post['slug']}")."/???*.*";

		$files = glob($files_path);

	//	print_r($files);

    DB::table("urun_sablonlari")
    
    ->where('id', $post['id'])

    ->update(["other_files" => implode(",",$files)]);

		
	oturumAc();
			print_r($files);
//$_SESSION['files'] = $files;
		$return = null;