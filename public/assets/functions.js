document.addEventListener('DOMContentLoaded', e => {
  trackCategoryClick()
})

function trackCategoryClick () {
  const http = new XMLHttpRequest()
  document.addEventListener('click', e => {
    if (e.target.classList.contains('category-button')) {
      e.preventDefault()
      new Promise((resolve, reject) => {
        http.open('GET', e.target.dataset.targeturl, true)
        http.setRequestHeader('X-Requested-With', 'XMLHttpRequest')
        http.onload = () => {
          if (http.status >= 200 && http.status <= 299) {
            try {
              resolve(renderSubCategory(JSON.parse(http.responseText)))
            } catch (error) {
              console.error(error)
            }
          } else {
            reject(returnError(http.status, http.responseText))
          }
        }
        http.send()
      })

    }
  })
}

const renderSubCategory = data => {
  if (typeof data.sub_categories !== 'undefined') {
    let html = ''
    data.sub_categories.map(subcategory => {
      html += `<div class="column is-one-third sub-category" onClick="window.location.href='${subcategory.productsUrl}'">
      <div class="sub-content">
      <figure class="image">
        <img src="${subcategory.image}" />
      </figure>
      <h2>${subcategory.name}</h2>
      </div>
    </div>`
    })
    document.querySelector('.sub-categories').innerHTML = html
  }
}

const returnError = (status, response) => {
  alert(`Error ${status}: ${response}`)
}