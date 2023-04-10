<div class="content">
    <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title"><i class="fa fa-{{$c->icon}}"></i> {{e2($c->title)}}</h3>
            </div>
            <div class="block-content">
                <?php if(getisset("add")) {
                    
                    unset($_POST['_token']);

                    ekle2([
                        'json' => json_encode_tr($_POST)
                    ],"varsayilan_varyantlar");
                    
                    bilgi("Varsayılan varyantlar güncellendi");
                } 
                $array = productArray();
                ?>
                <form action="?add" method="post">
                    @csrf
                    @include("admin.type.urun-sablonlari.edit-form-content")
                    <button class="btn btn-primary btn-hero mt-5">Kaydet</button>
                </form>
            </div>

            

        </div>

    </div>
</div>