<?php function base64image($base,$path) {
     $base = str_replace("data:image/jpeg;base64,","",$base);
     $base = str_replace("data:image/png;base64,","",$base);
     $ifp = fopen( $path, "wb" ); 
        fwrite( $ifp, base64_decode( $base) ); 
        fclose( $ifp ); 
    return( $path ); 
   
} ?>