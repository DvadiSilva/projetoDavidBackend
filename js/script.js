document.addEventListener("DOMContentLoaded", ()=>{
    const createCategoryButton= document.querySelector("#createCategoryButton");
    const categoriesCreateForm= document.querySelector("#categoriesCreateForm");

    createCategoryButton.addEventListener("click", ()=>{
        categoriesCreateForm.classList.remove("hide");
        categoriesCreateForm.classList.add("d-flex");
        categoriesCreateForm.classList.add("align-items-center");
    });
});