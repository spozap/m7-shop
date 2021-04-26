let filtering = false

let container = document.getElementById('product-container')

document.getElementById("submit").addEventListener('click' , (e) => {
   
    container.innerHTML = ""

    let body = new FormData

    let product = document.getElementById('product')

    if (product.value){

        body.append("product" , product.value)
        console.log(product.value)
        
    }

    let category = document.getElementById('category')
    let catSelected = category.options[category.selectedIndex].text
    
    if (catSelected !== "Seleccionar categoría"){

        body.append("category" , catSelected)

    }
    
    let order = document.getElementById('order')
    let ordSelected = order.options[order.selectedIndex].text

    if (ordSelected !== "Ordenar por...") {

        body.append("order" , ordSelected)
    }

    let from = document.getElementById("from")
    let to = document.getElementById("to")

    if (from.value && to.value) {

        body.append("from" , from.value)
        body.append("to" , to.value)

    }
   


    e.preventDefault();
    

    fetch('../db/showProductsMatchingFilters.php' , { method: 'POST',  body: body })
    .then(response => response.json())
    .then(data => {

        
        if (data.length !== 0) {
            data.forEach(product => {

                createCard(product)
    
            })
        } else {
            alert("NO SE HA ENCONTRADO NINGUN PRODUCTO")
        }

    })

    filtering = true
})


if (!filtering) {

    container.innerHTML = ""
    console.log("NO PARAMS")

    fetch('../db/showPaginatedProducts.php').then(response => response.json())
    .then(data => {
        
        console.log(data)

        data.forEach(product => {
            
            createCard(product)

        })  
    }  
    )

} 



const createCard = (product) => {


    let card = document.createElement('div')
    card.classList.add("card","product")
    
    let image = document.createElement('img')
    image.classList.add("card-img-top")
    image.src = product.images.split("\n")[0]
    image.alt = "Card image top"

    card.appendChild(image)

    let cardBody = document.createElement('div')
    cardBody.classList.add("card-body")

    let title = document.createElement('p')
    title.innerHTML = product.name
    let price = document.createElement('p')
    price.innerHTML = product.precio
    let published = document.createElement('p')
    published.innerHTML = product.creado

    let moreInfo = document.createElement('a')
    moreInfo.href = 'specs.php?product_id=' + product.id;
    moreInfo.innerHTML = "+ Info"
    moreInfo.classList.add("btn" , "btn-primary")
    

    cardBody.appendChild(title)
    cardBody.appendChild(price)
    cardBody.appendChild(published)
    cardBody.appendChild(moreInfo)

    card.appendChild(cardBody)

    container.appendChild(card)
}
