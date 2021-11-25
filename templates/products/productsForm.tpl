
{include file="templates/header.tpl"}

<div class="container">
    <div>
        <h3>Editar producto</h3>
        <form action="{BASE_URL}/editProduct/{if $product != null}edit{else}new{/if}" method="POST" enctype="multipart/form-data" class="my-4">
            <div class="row">
                <div class="col-9">

                    <div class="form-group">

                        <label>Nombre</label>
                        <input name="name" type="text" class="form-control" value="{if $product != null}{$product->name}{else}{/if}">

                    </div>
                    <div class="form-group">

                        <label>Precio</label>
                        <input name="price" type="text" class="form-control" value="{if $product != null}{$product->price|floatval}{else}{/if}">

                    </div>
                    <div class="form-group">

                        <label>Talle</label>

                            <select class="form-select" name="size">
                                {foreach from=$sizes item=$size }
                                    <option value="{$size}"{if $product != null && $product->size === $size}selected{else}{/if}>{$size|upper}</option>
                                {/foreach}
                            </select>

                    </div>
                    <div class="form-group">

                        <label>Categoria</label>

                        <select class="form-select" name="category_id">
                            {foreach from=$categories item=$category }
                                <option value="{$category->id}" {if $product != null && $product->category_id === $category->id}selected{else}{/if}>{$category->name|upper}</option>
                            {/foreach}
                        </select>

                    </div>
                    <div class="form-group">

                        {if isset($product->image)}
                            <img src="{$product->image}" height="120" width="80">
                            <a class="dropdown-item" href="deleteImage/{$product->id}">Borrar Imagen</a>
                        {else}
                            <div class="form-group">
                                <input type="file" name="input_name" id="imageToUpload" class="my-3" >
                            </div>
                        {/if}
                
                        <input name="id" type="hidden" value="{if $product != null}{$product->id}{else}{/if}">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-2">Guardar</button>

        </form>
    </div>
</div>

{include file="templates/footer.tpl" assign=name var1=value}

