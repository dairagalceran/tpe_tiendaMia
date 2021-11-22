"use strict";
//chequear
const  API_URL = "http://localhost/tiendaMia/api/comments'";
let comments =[];


async function descargarCommentsProductId(id) {
    try {
        const response = await fetch(API_URL  + '/product/'+ id)
        let commentsByProduct =response.json();
        comments = commentsByProduct;
       render();
    } catch (error) {
        console.log(error + "Descargar comentarios del producto  "+id);
    }

}

descargarCommentsProductId(id);

let form = document.querySelector("#create-comment-form");
form.addEventListener('submit', addComment);

async function addComment(e){
    e.preventDefault();
    console.log( 'dentro de add'); 
    let data = new FormData(form);
    let comment = {                   
        score: data.get('score'),
        comment: data.get('comment'),
        user: data.get('id_user'),
        product: data.get('id_product'),   
        
    }
    console.log( 'dentro de add 2'); 
    try {
        let response  = await fetch(API_URL,{
            method: "POST",
            headers:{
                "Content-Type": "application/json",
            },
            body: JSON.stringify(comment),
        });
        if (response.ok){
            let comment = await response.json();
            comments.push(comment);
            descargarComments();
            //clearForm();
        }
    } catch (e) {
        console.log(error);
    }
}


function render(){
    let list = document.querySelector("#comments-list");
    list.innerHTML= "";
    for(const comment of comments){
        let html = `
        <li class="list-group-item d-flex">
        ${comment.score} | ${comment.comment}
            <div class="acciones ms-auto">
                <button class=" btn-delete-task"  data-id="${comment.id}">Delete </a>
                <button class="btn-edit-task finalizada"  data-id"">Done</button>
            </div>
        </li>`;
        list.innerHTML += html;
    }
    //setListener(); //inicializar los eventListener
}


async function descargarComments() {
    try {
        const response = await fetch(API_URL);
        let newComments =await response.json();
        comments = newComments;
        render();
    } catch (error) {
        console.log(error);
    }
}


/*


async function descargarCommentsProductId(id) {
    try {
        const response = await fetch(API_URL  + '/product/'+ id)
        return response.json();
    } catch (error) {
        console.log(error + "Descargar comentarios del producto  "+id);
    }
}
async function crearComment(data) {
    try {
        const response = await fetch(API_URL , {
            method: 'POST',
            mode: 'cors',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        });
        if (response === 201) {
            console.log("Creado");
            return response.json();
        }
    } catch (error) {
        console.log(error + "Error post");
    }
}

async function eliminarComment(id) {
    try {
        const response = await fetch(API_URL + id, {
            method: 'DELETE'
        });
        return response.json();
    } catch (error) {
        console.log(error + "Error delete");
    }
}*/