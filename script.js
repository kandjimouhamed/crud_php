const toastLiveExample = document.getElementById('liveToast')
const toastMessage = document.getElementById('toastMessage')

window.addEventListener('load', () =>{
    console.log(document.title);
    if (document.title) {     
        toastMessage.textContent = `Vous étes sur la page "${document.title}"`
        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
        toastBootstrap.show()
    }

})
