import React from 'react';
import { Link, useNavigate } from 'react-router-dom';
import { Menu, Search, User, ShoppingBag } from 'lucide-react';

function Navbar() {
  const navigate = useNavigate();

  return (
    <nav className="bg-white shadow-sm">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex justify-between h-16">
          <div className="flex">
            <Link to="/" className="flex-shrink-0 flex items-center">
              <span className="text-xl font-bold">Your Logo</span>
            </Link>
            
            <div className="hidden sm:ml-6 sm:flex sm:space-x-8">
              <Link
                to="/"
                className="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-900"
              >
                Home
              </Link>
              
              <div className="relative group">
                <button className="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-900">
                  Skincare
                </button>
                <div className="absolute z-10 hidden group-hover:block w-48 bg-white rounded-md shadow-lg py-1">
                  <Link
                    to="/products/skincare/cleansers"
                    className="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                  >
                    Cleansers
                  </Link>
                  <Link
                    to="/products/skincare/serums"
                    className="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                  >
                    Serums
                  </Link>
                  <Link
                    to="/products/skincare/moisturizers"
                    className="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                  >
                    Moisturizers
                  </Link>
                  <Link
                    to="/products/skincare"
                    className="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                  >
                    All Skincare
                  </Link>
                </div>
              </div>

              <div className="relative group">
                <button className="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-900">
                  Haircare
                </button>
                <div className="absolute z-10 hidden group-hover:block w-48 bg-white rounded-md shadow-lg py-1">
                  <Link
                    to="/products/haircare/shampoos"
                    className="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                  >
                    Shampoos
                  </Link>
                  <Link
                    to="/products/haircare/conditioners"
                    className="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                  >
                    Conditioners
                  </Link>
                  <Link
                    to="/products/haircare"
                    className="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                  >
                    All Haircare
                  </Link>
                </div>
              </div>

              <Link
                to="/about"
                className="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-900"
              >
                About
              </Link>
            </div>
          </div>

          <div className="flex items-center">
            <button
              onClick={() => navigate('/search')}
              className="p-2 rounded-md text-gray-400 hover:text-gray-500"
            >
              <Search className="h-5 w-5" />
            </button>
            <button
              onClick={() => navigate('/account')}
              className="p-2 rounded-md text-gray-400 hover:text-gray-500"
            >
              <User className="h-5 w-5" />
            </button>
            <button
              onClick={() => navigate('/cart')}
              className="p-2 rounded-md text-gray-400 hover:text-gray-500"
            >
              <ShoppingBag className="h-5 w-5" />
            </button>
          </div>
        </div>
      </div>
    </nav>
  );
}

export default Navbar;