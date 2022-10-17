document.addEventListener("DOMContentLoaded", ()=>{
    //formulário de criar categoria
    const createCategoryButton= document.querySelector("#createCategoryButton");
    const categoriesCreateForm= document.querySelector("#categoriesCreateForm");

    createCategoryButton.addEventListener("click", ()=>{
        categoriesCreateForm.classList.remove("d-none");
        categoriesCreateForm.classList.add("d-flex");
        categoriesCreateForm.classList.add("align-items-center");
    });


    //modal
    const showModals=document.querySelectorAll(".deleteCategoryShowModal");
    const modalWrappers=document.querySelectorAll(".deleteCategoryModalWrapper");
    const closeModals=document.querySelectorAll(".deleteCategoryCloseModal");
    const closeModals2=document.querySelectorAll(".deleteCategoryCloseModal2");
    const deleteCategoryButtons=document.querySelectorAll(".deleteCategoryButton");

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

    for(let i = 0; i < closeModals2.length; i++){

        closeModals2[i].addEventListener("click", ()=>{
            modalWrappers[i].classList.add("d-none");
        });
    }
    
    //butao "Sim" de remover
    for(let deleteCategoryButton of deleteCategoryButtons){
        const removeCategoryData= "category_id="+deleteCategoryButton.dataset.categoryId;
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
    
});