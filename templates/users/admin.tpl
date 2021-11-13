{include file="templates/header.tpl"}

<div class="container ">
   
    <h3>{$titleAdmin}</h3>
    {if $error} 
        <div class="alert alert-danger mt-4">
            {$error}
        </div>
    {/if}
    <div class="table mt-5 col-md-5">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" >Nombre</th>
                    <th scope="col" >Correo electrónico</th>
                    <th scope="col" >Rol</th>
                
                </tr>
            </thead>
            <tbody>
            {foreach from=$users item=$user }
                    <tr>
                        <td scope="row">{$user->name|upper}</td>
                            <td>{$user->email|capitalize}</td>
                            {if $user->is_admin==0}
                                <td>Usuario</td>
                            {else}
                                <td>Administrador</td>
                            {/if}
                            <td><a class="btn btn-success" href="{BASE_URL}/deleteUser/{$user->id}/{$user->is_admin}">Eliminar</a> </td>
                            <td><a class="btn btn-success" href="{BASE_URL}/editRol/{$user->id}/{$user->is_admin} ">Editar Rol</a>
                    </tr>
            {/foreach}     
            </tbody>
        </table> 
    </div>
</div>


{include file="templates/footer.tpl" assign=name var1=value}