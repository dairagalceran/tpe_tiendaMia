"use strict"

const BASE_URL = "http://localhost/tiendaMia/api/";



function getProductId() {
    let commentsContainer = document.querySelector("#comments");
    let productId = commentsContainer.getAttribute("data-product-id");
    return productId;
}



function renderComment(comment,deleteEnabled){
    return `<li class="list-group-item ">
    <p>${comment.user_name} :  ${comment.comment}<p>  <b>Puntaje: ${comment.score}</b></p>
    <p>${comment.created_at} </p>` +
    (deleteEnabled ? 
        `<div class="acciones ms-auto">
            <a class="btn btn-sm btn-danger btn-delete-comment" data-comment-id="${comment.id}" >Borrar</a>
        </div>` : '')
        +`</li>`;
}


async function loadComments(){
    let productId = getProductId();
    let commentsContainer = document.querySelector("#comments");
    let deleteEnabled = commentsContainer.getAttribute("data-delete-enabled");
    try{

        let  response = await fetch(BASE_URL  + 'comments/product/'+ productId);
        let commentsByProduct = response.ok ? await response.json() : [] ;
        commentsContainer.innerHTML = '';
        for (var comment of commentsByProduct) {
            commentsContainer.innerHTML += renderComment(comment, deleteEnabled == "1")
        }  
    } catch(e){
        console.log(e);
    }
    setupListeners();
}

function setupListeners(){
    document.querySelectorAll(".btn-delete-comment").forEach(item => {
         item.addEventListener('click',  deleteComment);
     });

}

let btnCreateComment = document.querySelector("#btn-create-comment");
if(btnCreateComment){
    btnCreateComment.addEventListener('click', addComment);
}


async function addComment(e){
    e.preventDefault();

    let form = document.querySelector("#create-comment-form");
    let data = new FormData(form);

    let text = data.get('comment');
    if(!text || text.trim().length == 0 ){
        alert('Debes escribir un comentario');
        return false;
    }
    let scoreValue = data.get('score');
    if(!scoreValue ){
        alert('Debes puntuar el producto');
        return false;
    }

    let comment = {                    
        score: data.get('score'),
        comment: data.get('comment'),   
        product_id: data.get('product_id'),
    };
    
    try {
        let response  = await fetch(BASE_URL +'comments',{
            method: "POST",
            headers:{
                "Content-Type": "application/json",
            },
            body: JSON.stringify(comment),
        });
        if (response.ok){
            let comment =await response.json;
            clearForm();
            loadComments();           
        }
    } catch (e) {
        console.log(e);
    }
}

async function deleteComment(e){
    let commentId = this.getAttribute("data-comment-id");
    await remove(commentId);
    loadComments();
}

async function remove(id) {
    try {
        const response = await fetch( BASE_URL + 'comments/'+id, {
            method: 'DELETE'
        });
        return response.json();

    } catch (error) {
        console.log(error + "Error delete");
    }
}

function  clearForm(){
    document.querySelectorAll("#create-comment-form .form-control").forEach(item=>item.value="");
}


loadComments();