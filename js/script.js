document.addEventListener("DOMContentLoaded", ()=>{
    //formulário de criar categoria
    const createCategoryButton= document.querySelector("#createCategoryButton");
    const categoriesCreateForm= document.querySelector("#categoriesCreateForm");

    if(createCategoryButton){
        createCategoryButton.addEventListener("click", ()=>{
            categoriesCreateForm.classList.remove("d-none");
            categoriesCreateForm.classList.add("d-flex", "align-items-center");
        });
    }

    function createModal(showModals, modalWrappers, closeModals){
        for(let i = 0; i < showModals.length; i++){

            showModals[i].addEventListener("click", ()=>{
                
                modalWrappers[i].classList.remove("d-none");
            });
        }
    
        for(let i = 0; i < closeModals.length; i++){
    
            closeModals[i].addEventListener("click", ()=>{
                modalWrappers[i].classList.add("d-none");
            });
        }
    }

    //modal delete category
    const deleteCategoryShowModals=document.querySelectorAll(".deleteCategoryShowModal");
    const deleteCategoryModalWrappers=document.querySelectorAll(".deleteCategoryModalWrapper");
    const deleteCategoryCloseModals=document.querySelectorAll(".deleteCategoryCloseModal");
    const deleteCategoryCloseModals2=document.querySelectorAll(".deleteCategoryCloseModal2");
    const deleteCategoryButtons=document.querySelectorAll(".deleteCategoryButton");

    createModal(deleteCategoryShowModals, deleteCategoryModalWrappers, deleteCategoryCloseModals);

    for(let i = 0; i < deleteCategoryCloseModals2.length; i++){

        deleteCategoryCloseModals2[i].addEventListener("click", ()=>{
            deleteCategoryModalWrappers[i].classList.add("d-none");
        });
    }
    
    //butao "Sim" de delete category
    for(let deleteCategoryButton of deleteCategoryButtons){
        const removeCategoryData= "removeCategory_id="+deleteCategoryButton.dataset.categoryId;
        const tr= deleteCategoryButton.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode;
        
        deleteCategoryButton.addEventListener("click", ()=>{
            fetch("/admin/categories", {
                method:"POST",
                headers:{
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body:removeCategoryData
            })
            .then(response=>{
                if(response.status==200){
                    tr.remove();
                }else{
                    alert("Ocorreu um erro, tente mais tarde");
                }
            });
        });
    }
    
    //modal edit category
    const editCategoryShowModals=document.querySelectorAll(".editCategoryShowModal");
    const editCategoryModalWrappers=document.querySelectorAll(".editCategoryModalWrapper");
    const editCategoryCloseModals=document.querySelectorAll(".editCategoryCloseModal");

    createModal(editCategoryShowModals, editCategoryModalWrappers, editCategoryCloseModals);

    //modal delete user
    const deleteUserShowModals=document.querySelectorAll(".deleteUserShowModal");
    const deleteUserModalWrappers=document.querySelectorAll(".deleteUserModalWrapper");
    const deleteUserCloseModals=document.querySelectorAll(".deleteUserCloseModal");
    const deleteUserCloseModals2=document.querySelectorAll(".deleteUserCloseModal2");
    const deleteUserButtons=document.querySelectorAll(".deleteUserButton");

    createModal(deleteUserShowModals, deleteUserModalWrappers, deleteUserCloseModals);

    for(let i = 0; i < deleteUserCloseModals2.length; i++){

        deleteUserCloseModals2[i].addEventListener("click", ()=>{
            deleteUserModalWrappers[i].classList.add("d-none");
        });
    }

    //butao "Sim" de user
    for(let deleteUserButton of deleteUserButtons){
        const removeUserData= "removeUser_id="+deleteUserButton.dataset.userId;
        const tr= deleteUserButton.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode;
        
        deleteUserButton.addEventListener("click", ()=>{
            fetch("/admin/users", {
                method:"POST",
                headers:{
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body:removeUserData
            })
            .then(response=>{
                if(response.status==200){
                    tr.remove();
                }else{
                    alert("Ocorreu um erro, tente mais tarde");
                }
            });
        });
    }

    //modal edit user
    const editUserShowModals=document.querySelectorAll(".editUserShowModal");
    const editUserModalWrappers=document.querySelectorAll(".editUserModalWrapper");
    const editUserCloseModals=document.querySelectorAll(".editUserCloseModal");

    createModal(editUserShowModals, editUserModalWrappers, editUserCloseModals);

    //modal change password
    const changePasswordShowModal=document.querySelector(".changePasswordShowModal");
    const changePasswordModalWrapper=document.querySelector(".changePasswordModalWrapper");
    const changePasswordCloseModal=document.querySelector(".changePasswordCloseModal");

    if(changePasswordShowModal){

        changePasswordShowModal.addEventListener("click", ()=>{
            
            changePasswordModalWrapper.classList.remove("d-none");
        });
        
        
        changePasswordCloseModal.addEventListener("click", ()=>{
            changePasswordModalWrapper.classList.add("d-none");
        });
    }

    //close navbar
    const navBarClose= document.querySelector("#navBarClose");
    const navBarOpen= document.querySelector("#navBarOpen");

    if(navBarClose){
        navBarClose.addEventListener("click", ()=>{
            navBarClose.parentNode.classList.add("d-none");
            navBarOpen.classList.remove("d-none");
        });
        
        navBarOpen.addEventListener("click", ()=>{
            navBarClose.parentNode.classList.remove("d-none");
            navBarOpen.classList.add("d-none");
        });
    }

    //comment
    const commentButton= document.querySelector(".commentButton");
    const commentInput= document.querySelector("#commentInput")
    const comments= document.querySelector(".comments");
    const userPhoto= document.querySelector("#userPhoto");
    const body= document.querySelector("body");

    if(commentButton){

        commentButton.addEventListener("click", ()=>{
            if(commentInput.value.length>=1 && commentInput.value.length<= 140){

                const data= "comment="+commentInput.value;
                
                fetch("/news/"+commentInput.dataset.newsId,{
                    method:"POST",
                    headers:{
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body:data
                })
                .then(response=>{
if(response.status==200){
    comments.prepend(document.createElement("div"));
    comments.firstElementChild.classList.add("d-flex", "align-items-center", "p-3", "border", "rounded", "border-dark", "m-3", "bg-light", "bg-gradient", "position-relative");
    
    comments.firstElementChild.appendChild(document.createElement("img"));
    comments.firstElementChild.lastElementChild.classList.add("commentImg");
    comments.firstElementChild.lastElementChild.src= userPhoto.src;

    comments.firstElementChild.appendChild(document.createElement("div"));
    comments.firstElementChild.lastElementChild.classList.add("mx-3");
    
    comments.firstElementChild.lastElementChild.appendChild(document.createElement("p"));
    comments.firstElementChild.lastElementChild.lastElementChild.classList.add("mb-0", "fw-bold");
    comments.firstElementChild.lastElementChild.lastElementChild.textContent= userPhoto.dataset.username;

    comments.firstElementChild.lastElementChild.appendChild(document.createElement("p"));
    comments.firstElementChild.lastElementChild.lastElementChild.textContent= commentInput.value;
    comments.firstElementChild.lastElementChild.lastElementChild.classList.add("mb-0");
    
    comments.firstElementChild.appendChild(document.createElement("div"));
    comments.firstElementChild.lastElementChild.classList.add("position-absolute", "bottom-0", "end-0", "m-3");

    comments.firstElementChild.lastElementChild.appendChild(document.createElement("time"));
    comments.firstElementChild.lastElementChild.lastElementChild.textContent= "Agora";

    
    commentInput.value= "";
}else{
    alert("Ocorreu um erro, tente mais tarde");
}
                });
            }
        });
    }


    //modal delete comment
    const deleteCommentShowModals=document.querySelectorAll(".deleteCommentShowModal");
    const deleteCommentModalWrappers=document.querySelectorAll(".deleteCommentModalWrapper");
    const deleteCommentCloseModals=document.querySelectorAll(".deleteCommentCloseModal");
    const deleteCommentCloseModals2=document.querySelectorAll(".deleteCommentCloseModal2");
    const deleteCommentButtons=document.querySelectorAll(".deleteCommentButton");

    createModal(deleteCommentShowModals, deleteCommentModalWrappers, deleteCommentCloseModals);

    for(let i = 0; i < deleteCommentCloseModals2.length; i++){

        deleteCommentCloseModals2[i].addEventListener("click", ()=>{
            deleteCommentModalWrappers[i].classList.add("d-none");
        });
    }

    //butao "Sim" de user
    for(let deleteCommentButton of deleteCommentButtons){
        const removeCommentData= "removeComment_id="+deleteCommentButton.dataset.commentId;
        const tr= deleteCommentButton.parentNode.parentNode.parentNode.parentNode.parentNode;
        
        deleteCommentButton.addEventListener("click", ()=>{
            fetch("/admin/comments", {
                method:"POST",
                headers:{
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body:removeCommentData
            })
            .then(response=>{
                if(response.status==200){
                    tr.remove();
                }else{
                    alert("Ocorreu um erro, tente mais tarde");
                }
            });
        });
    }
});