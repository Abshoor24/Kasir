
const Navbar = () => {

const goToLogin = () => {
  window.location.href = 'http://localhost:8000/login'
}

const goToRegister = () => {
  window.location.href = 'http://localhost:8000/register'
}


  return (
     <nav className="w-full bg-[#BBE1FA] fixed top-0 left-0 z-50 mt-6 font-inter">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex items-center justify-between h-16">
          {/* Logo */}
          <div className="flex-shrink-0">
            <a href="/" className="text-4xl font-bold text-blue-600 tracking-tight">
              LynkID Clone
            </a>
          </div>

          {/* Menu */}
          <div className="hidden md:flex items-center space-x-10 text-2xl mr-6">
            <a href="#"
              onClick={(e) => {
                e.preventDefault();
                goToLogin();
              }}
              className="text-black hover:text-blue-600 bold hover:scale-105 transition-transform duration-200"
            >
              Login
            </a>
            <button
              onClick={goToRegister}
              className="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 hover:scale-105 transition-transform duration-200"
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