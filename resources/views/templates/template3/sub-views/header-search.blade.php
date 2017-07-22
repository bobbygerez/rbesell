<form action="form.php" class="form form-search-header">
    <select name="show-categories" id="show-categories">
        <option value="all">All Categories</option>
        @foreach($browseCategories as $browseCategory)
        	<option value="9">{{ $browseCategory->getOriginal('name') }}</option>
        @endforeach
    </select>
        <input type="text" placeholder="Search...">
    <button class="button-search"><i class="flaticon-search"></i></button>
</form>