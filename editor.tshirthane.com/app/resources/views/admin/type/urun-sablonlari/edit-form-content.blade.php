<?php 
$path = "admin.type.urun-sablonlari";

foreach($array AS $name => $value) { ?>
<div class="col-md-12">
                                <div class="border p-10 mb-5 mt-5 rounded">
                                    {{$name}} 
                                    
                                    
                                    <?php if(is_array($value)) {
                                        ?>
                                        <div class="row">
                                            
                                            <?php 
                                                foreach($value AS $name2 => $value2) {
                                                    ?>
                                                    <div class="col-md-6 {{$name}} {{$name}}{{$name2}}">
                                                        <div class="border p-10 mb-10 rounded ">
                                                            
                                                            <?php if(is_array($value2)) {
                                                                foreach($value2 AS $name3 => $value3) {
                                                                    ?>
                                                                    {{$name3}}
                                                                 <?php 
                                                                switch ($name3) {
                                                                    
                                                                    case 'currency':
                                                                        $selectName = $name. "[$name2][$name3]";
                                                                        $selectValue = isset($j[$name][$name2][$name3]) ? $j[$name][$name2][$name3] : "TL";
                                                                         ?>
                                                                        @include("$path.currency")
                                                                         <?php 
                                                                        break;
                                                                    
                                                                    default:
                                                                            $defaultName = $name . "[$name2][$name3]";
                                                                            $defaultValue = 
                                                                            isset($j[$name][$name2][$name3]) ? $j[$name][$name2][$name3] : $value3;
                                                                            $defaultPlaceHolder = $value3;

                                                                        ?>
                                                                            @include("$path.default")
                                                                           
                                                                     <?php 
                                                                        break;
                                                                }
                                                            ?>
                                                                    
                                                                    <?php 
                                                                }
                                                                ?>
                                                             
                                                                <?php 
                                                            } else  { 
                                                                 ?>
                                                                 {{$name2}}
                                                                 <?php 
                                                                switch ($name2) {
                                                                    
                                                                    case 'currency':
                                                                        $selectName = $name . "[$name2]";
                                                                        $selectValue = isset($j[$name][$name2]) ? $j[$name][$name2] : "TL";
                                                                         ?>
                                                                         @include("$path.currency")
                                                                         <?php 
                                                                        break;
                                                                    
                                                                    default:
                                                                        $defaultName = $name . "[$name2]";
                                                                        $defaultValue = isset($j[$name][$name2]) ? $j[$name][$name2] : "TL";
                                                                        $defaultPlaceHolder = $value2;

                                                                     ?>
                                                                        @include("$path.default")
                        
                                                                     <?php 
                                                                        break;
                                                                }
                                                            ?>
                                                            
                                                           
                                                            <?php } ?>
                                                            <?php if($name=="variants") {
                                                                 ?>
                                                                 <div data-class="{{$name}}{{$name2}}" class="btn btn-danger variant-delete mt-5">Sil</div>
                                                                 <?php 

                                                            } ?>
                                                        </div>
                                                    </div>
                                                    <?php 
                                                }
                                            ?>
                                            <?php if($name=="variants") { ?>
                                                <div class="col-12">
                                                    <div class="btn btn-primary"><i class="fa fa-plus"></i> Variant Ekle</div>
                                                </div>
                                                <?php 
                                            } ?>
                                        </div>
                                    <?php 
                                
                                    } else  { 
                                        //echo "($value)";
                                        switch ($name) {
                                            case 'currency':
                                                    $selectName = $name;
                                                    $selectValue = isset($j[$name]) ? $j[$name] : "TL";
                                                 ?>
                                                 @include("$path.currency")
                                                 <?php 
                                                break;
                                            
                                            default:
                                                $defaultName = $name;
                                                $defaultValue = isset($j[$name]) ? $j[$name] : $value;
                                                $defaultPlaceHolder = $value;

                                             ?>
                                             @include("$path.default")

                                             <?php 
                                                break;
                                        }
                                    ?>
                                    <?php } ?>
                                </div>
                            </div>
    <?php } ?>