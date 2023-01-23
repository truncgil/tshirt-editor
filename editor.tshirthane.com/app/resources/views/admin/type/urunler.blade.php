<div class="content">
    <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title"><i class="fa fa-{{$c->icon}}"></i> {{e2($c->title)}}</h3>
            </div>
            <div class="block-content">
            <?php $urunler = db("urunler")->orderBy("id","DESC")->simplePaginate(20);  ?>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Ürün Adı</th>
                            <th>Mockup</th>
                            <th>Raw Görsel</th>
                        </tr>
                       <?php foreach($urunler AS $urun)  { 
                         ?>
                         <tr>
                             <td>{{$urun->title}}</td>
                             <td>
                                <a href="{{url($urun->mockup)}}" class="btn btn-primary" download>İndir</a>
                             </td>
                             <td>
                                <a href="{{url($urun->raw)}}" class="btn btn-success" download>İndir</a>
                             </td>
                         </tr> 
                        <?php } ?>
                    </table>
                </div>
            </div>

            

        </div>

    </div>
</div>