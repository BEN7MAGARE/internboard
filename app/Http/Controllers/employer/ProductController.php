<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function __construct(Product $product)
    {
        $this->middleware('employer');
        $this->product = new Product();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->product->where('corporate_id', auth()->user()->corporate_id)->paginate(8);
        return view('employer.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = $this->product->where('corporate_id', auth()->user()->corporate_id)->paginate(10);
        return view('employer.products.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $validated = $request->validated();
        $validated['corporate_id'] = auth()->user()->corporate_id;
        if ($request->id !== '' && $request->id !== null) {
            $product = $this->product->find($request->id);
            $images = json_decode($product->image, true);
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $filename = strtoupper(Str::random(3)) . strtotime(now()) . '.' . $image->getClientOriginalExtension();
                    Log::info($filename);
                    $image->move(public_path('productimages'), $filename);
                    $images[] = $filename;
                }
            } else {
                Log::alert('Files Imagesddd');
            }
            $validated['image'] = json_encode($images);
            $product->update($validated);
            return response()->json(['status' => 'success', 'message' => 'Product updated successfully']);
        } else {
            $images = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $filename = strtoupper(Str::random(3)) . strtotime(now()) . '.' . $image->getClientOriginalExtension();
                    Log::info($filename);
                    $image->move(public_path('productimages'), $filename);
                    array_push($images, $filename);
                }
            } else {
                Log::alert('No files');
            }
            $validated['image'] = json_encode($images);
            $this->product->create($validated);
            return response()->json(['status' => 'success', 'message' => 'Product created successfully']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = $this->product->find($id);
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = $this->product->find($id);
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $validated = $request->validated();
        $product = $this->product->find($id);
        $images = json_decode($product->image, true);
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = strtoupper(Str::random(3)) . strtotime(now()) . '.' . $image->getClientOriginalExtension();
                Log::alert($filename);
                $image->move(public_path('productimages'), $filename);
                array_push($images, $filename);
            }
        }
        $validated['image'] = json_encode($images);
        $product->update($validated);
        return response()->json(['status' => 'success', 'message' => 'Product updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = $this->product->find($id);
        $product->delete();
        return response()->json(['status' => 'success', 'message' => 'Product deleted successfully']);
    }

    public function deleteProductImage($id,Request $request)
    {
        $request->validate([
            'image' => 'required|string',
        ]);

        $product = $this->product->findOrFail($request->id);

        // Decode the current images array
        $images = json_decode($product->image, true) ?? [];

        if (!in_array($request->image, $images)) {
            return response()->json(['status' => 'error', 'message' => 'Image not found in product'], 404);
        }

        // Delete the image file if it exists
        $imagePath = public_path("productimages/{$request->image}");
        if (file_exists($imagePath)) {
            @unlink($imagePath);  // @ suppresses error if already deleted
        }

        // Remove the image from the array
        $updatedImages = array_values(array_filter($images, fn($img) => $img !== $request->image));

        // Update the product
        $product->update([
            'image' => json_encode($updatedImages),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Product image deleted successfully',
            'remaining_images' => $updatedImages,
        ]);
    }
}
