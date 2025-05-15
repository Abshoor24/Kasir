
const Navbar = () => {

const goToLogin = () => {
  window.location.href = 'http://localhost:8000/login'
}

const goToRegister = () => {
  window.location.href = 'http://localhost:8000/register'
}


  return (
     <nav className="w-full bg-[#d2e7f6] fixed top-0 left-0 z-50 mt-6">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex items-center justify-between h-16">
          {/* Logo */}
          <div className="flex-shrink-0">
            <a href="/" className="text-4xl font-bold text-blue-600 tracking-tight">
              Kasir
            </a>
          </div>

          {/* Menu */}
          <div className="hidden md:flex items-center space-x-10 text mr-6">
            <a href="#"
              onClick={(e) => {
                e.preventDefault();
                goToLogin();
              }}
              className="text-black hover:text-blue-600 bold hover:scale-105 transition-transform duration-200  text-2xl font-inter"
            >
              Login
            </a>
            <button
              onClick={goToRegister}
              className="bg-blue-600 text-white px-4 py-[4px] rounded-md hover:bg-blue-700 hover:scale-105 transition-transform duration-200 w-32 text-xl font-thin"
            >
              Register
            </button>
          </div>
        </div>
      </div>
    </nav>
  )
}

export default Navbar;