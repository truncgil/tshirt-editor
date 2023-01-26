<select name="{{$selectName}}" required id="" class="form-control">
    <option value="">Seçiniz</option>
    <option value="TL" {{$selectValue=="TL" ? "selected" : ""}}>TL</option>
    <option value="USD" {{$selectValue=="USD" ? "selected" : ""}}>USD</option>
    <option value="EUR" {{$selectValue=="EUR" ? "selected" : ""}}>EUR</option>
</select>