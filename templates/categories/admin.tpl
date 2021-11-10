{include file="templates/header.tpl"}


<div class="container ">

    <h3>{$titulo}</h3>

    <div class="table mt-5 col-md-5">
        <table>
            <tr>
                <th scope="col" class=" list-group-item-success">{$titulo|upper} </th>
                <th scope="col" class=" list-group-item-secondary ">Editar</th>
                <th scope="col" class="list-group-item list-group-item-secondary ">Eliminar</th>
            </tr>             
            <tbody>
                {foreach from= $categories item=$category}
                    <tr>
                        <td> <a class="list-group-item list-group-item-action list-group-item-success"> {$category->name|upper} </a></td>
                        <td> <a class="btn btn-danger  list-group-item list-group-item-action list-group-item-secondary" href="{BASE_URL}/editCategory/{$category->id}">   Editar </a></td>
                        <td> <a class="btn btn-danger  list-group-item list-group-item-action list-group-item-secondary" href="{BASE_URL}/deleteCategory/{$category->id}">   Eliminar </a></td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
    </div>
</div>      

<form action="{BASE_URL}/postCategory" method="POST" class="my-4">
    <div class="row">
        <div class="col-9">
            <div class="form-group">
                <label>Agregar categoría</label>
                <input name="name" type="text" class="form-control" required>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary mt-2">Guardar</button>
</form>


{include file="templates/footer.tpl" assign=name var1=value}