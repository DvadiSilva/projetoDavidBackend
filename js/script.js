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
    const deleteCategoryShowModals=document.querySelectorAll(".deleteCategoryShowModal");
    const deleteCategoryModalWrappers=document.querySelectorAll(".deleteCategoryModalWrapper");
    const deleteCategoryCloseModals=document.querySelectorAll(".deleteCategoryCloseModal");
    const deleteCategoryCloseModals2=document.querySelectorAll(".deleteCategoryCloseModal2");
    const deleteCategoryButtons=document.querySelectorAll(".deleteCategoryButton");

    for(let i = 0; i < deleteCategoryShowModals.length; i++){

        deleteCategoryShowModals[i].addEventListener("click", ()=>{
            
            deleteCategoryModalWrappers[i].classList.remove("d-none");
        });
    }

    for(let i = 0; i < deleteCategoryCloseModals.length; i++){

        deleteCategoryCloseModals[i].addEventListener("click", ()=>{
            deleteCategoryModalWrappers[i].classList.add("d-none");
        });
    }

    for(let i = 0; i < deleteCategoryCloseModals2.length; i++){

        deleteCategoryCloseModals2[i].addEventListener("click", ()=>{
            deleteCategoryModalWrappers[i].classList.add("d-none");
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