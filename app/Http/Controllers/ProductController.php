<?php


use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getAllProducts();
        return response()->json(['products' => $products]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $data = $request->all();

        $this->productService->create($data);

        return response()->json(['message' => 'Product created successfully']);
    }

    public function delete($id)
    {
        $this->productService->delete($id);

        return response()->json(['message' => 'Product deleted successfully']);
    }

    public function filter($category)
    {
        $products = $this->productService->filterByCategory($category);

        return response()->json(['products' => $products]);
    }

    public function sort($by)
    {
        $products = $this->productService->sortBy($by);

        return response()->json(['products' => $products]);
    }

}
