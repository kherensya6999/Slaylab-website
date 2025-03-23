import React from 'react';
import { useParams } from 'react-router-dom';

function Products() {
  const { category, subcategory } = useParams();

  return (
    <div className="p-8">
      <h1 className="text-3xl font-bold mb-4">
        {subcategory
          ? `${subcategory.charAt(0).toUpperCase() + subcategory.slice(1)} ${category}`
          : category
          ? `All ${category.charAt(0).toUpperCase() + category.slice(1)}`
          : 'All Products'}
      </h1>
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        {/* Product cards will go here */}
      </div>
    </div>
  );
}

export default Products;