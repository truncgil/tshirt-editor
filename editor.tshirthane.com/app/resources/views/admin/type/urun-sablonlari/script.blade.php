<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-jcrop/0.9.15/css/jquery.Jcrop.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-jcrop/0.9.15/js/jquery.Jcrop.js"></script>
     
<script>
    $(function(){
        $("#imageAreas").Jcrop({
            onSelect: function(c){
                $.get("?edit={{get("edit")}}&save-area",{
                    areas : c
                });
                
                console.log(c);

                console.log(c.x);
                console.log(c.y);
                console.log(c.w);
                console.log(c.h);
            }
        });
        $(".variant-delete").on("click",function(){
            var id = $(this).attr("data-class");
            if(confirm("Bu varyant silinecektir emin misiniz?")) {
                $("." + id).remove();
            }
            
        })
    });
</script>