const callback = (entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      const animation = entry.target.dataset.animation
      entry.target.classList.add(`animate_${animation}`)
    } 
  });
}

const options = {
  threshold: 0.3
}

const observerAnimation = new IntersectionObserver(callback, options)


const elements = document.querySelectorAll("[data-animation]")



elements.forEach(element => observerAnimation.observe(element))
