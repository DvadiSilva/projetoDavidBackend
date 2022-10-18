document.addEventListener("DOMContentLoaded", ()=>{
    //formulário de criar categoria
    const createCategoryButton= document.querySelector("#createCategoryButton");
    const categoriesCreateForm= document.querySelector("#categoriesCreateForm");

    if(createCategoryButton){
        createCategoryButton.addEventListener("click", ()=>{
            categoriesCreateForm.classList.remove("d-none");
            categoriesCreateForm.classList.add("d-flex");
            categoriesCreateForm.classList.add("align-items-center");
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
});