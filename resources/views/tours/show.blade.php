<form action="{{ route('customer.bookings.store', $tour->id) }}" method="POST">
    @csrf
    <input type="hidden" name="tour_id" value="{{ $tour->id }}">

    <label for="guests">Number of Guests:</label>
    <input type="number" name="guests" min="1" value="1" required class="border p-2 mb-2">

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Book Now</button>
</form>

