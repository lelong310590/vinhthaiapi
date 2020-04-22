@if ($pers->contains('name','taxonomy_index'))
<li><a href="{{route('lito::taxonomy.index.get',['type'=>'category'])}}"><i class="fa fa-caret-right" aria-hidden="true"></i> Danh mục</a></li>
<li><a href="{{route('lito::taxonomy.index.get',['type'=>'tag'])}}"><i class="fa fa-caret-right" aria-hidden="true"></i> Quản lý Tag</a></li>
@endif