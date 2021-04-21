fetch('../db/showPaginatedProducts.php').then(response => response.json())
.then(data => {

    let container = document.getElementById('product-container')
    

    data.forEach(product => {

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
    })  
}  
)