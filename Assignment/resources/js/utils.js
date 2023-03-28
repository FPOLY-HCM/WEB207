import * as bootstrap from 'bootstrap'

const handleError = (error) => {
    const toastElement = document.getElementById('liveToast')
    const toast = bootstrap.Toast.getOrCreateInstance(toastElement)

    toast.show()
    toastElement.querySelector('.toast-body').innerHTML = error.data.message
}

export { handleError }
