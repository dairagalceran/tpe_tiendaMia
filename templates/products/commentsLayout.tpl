{include file='templates/header.tpl'}

    <div class="row mt-4">
        <div class="col-md-4">
           
            {include file='templates/productDetail.tpl'}
        </div>
        <div>
            {include file='vue/productCommentsForm.tpl'}
        </div>
        <div class="col-md-8">
            <!-- hueco  para lista commentes de un producto -->
            
            </ul>
        </div>
    </div>

    <script src="js/app.js"></script>
{include file='templates/footer.tpl'}
