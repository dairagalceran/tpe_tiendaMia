{include file="templates/header.tpl"}

<div class="container ">
    <h3>{$titleAdmin}</h3>

    <form action="{BASE_URL}/postProduct" method="POST" class="my-4" enctype="multipart/form-data">
        <div class="row">
            <div class="col-5">
                <h5>Agregar productos</h5>
                <div class="form-group">
                    <select class="form-select" name="category_id">
                        {foreach from=$categories item=$category }
                            <option value="{$category->id}">{$category->name|upper}</option>
                        {/foreach}
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Producto</label>
                    <input name="name" type="text" class="form-control" required>
                </div>
                <div class="form-group">
                    <select class="form-select" name="size">
                        {foreach from=$sizes item=$size }
                            <option value="{$size}">{$size|upper}</option>
                        {/foreach}
                    </select>
                </div>
                <div class="form-group">
                    <label for="price">Precio</label>
                    <input name="price" type="text" class="form-control" required>
                </div>
                <div class="form-group mt-3">
                    <input type="file" name="image_file" id="imageToUpload">
                </div>

            </div>
        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-primary mt-2">Guardar</button>
        </div>
    </form>



    <div class="table mt-5 col-md-5">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Categoria</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Talle</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                {foreach from=$products item=$product }
                    <tr>
                        <th scope="row">{$product->category|upper}</th>
                        <td>{$product->name|capitalize}</td>
                        <td>{$product->price}</td>
                        <td>{$product->size}</td>
                        <td><a class="btn btn-success" href="{BASE_URL}/productView/{$product->id}">Ver</a> </td>
                        <td><a class="btn btn-success" href="{BASE_URL}/editProductForm/{$product->id}">Editar</a> </td>
                        <td><a class="btn btn-success" href="{BASE_URL}/deleteProduct/{$product->id}">Eliminar</a> </td>

                        <input type="hidden" name="id" value={$product->id} />
                    </tr>
                {/foreach}
            </tbody>
        </table>
    </div>
</div>




{include file="templates/footer.tpl" assign=name var1=value}