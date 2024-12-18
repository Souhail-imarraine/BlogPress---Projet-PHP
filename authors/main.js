let btnAddArticle = document.querySelector(".btnAddArticle");
let containerCreateBlog = document.querySelector(".containerCreateBlog");

btnAddArticle.addEventListener("click", ()=> {
    containerCreateBlog.classList.remove("hidden");
    console.log("hhh")
});



let cancel = document.querySelector(".cancel");


cancel.addEventListener("click", () => {
    containerCreateBlog.classList.add("hidden");
})