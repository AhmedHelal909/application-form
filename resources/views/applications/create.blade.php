@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow-md rounded-xl p-8 mt-10">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Submit Application</h1>

    <form id="applicationForm" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Contact Email</label>
                <input type="email" name="contact_email" required
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200" />
            </div>

             <div class="mb-3">
        <label for="phone">Contact Phone</label>
        <input id="phone" type="tel" class="form-control" name="contact_phone">
        <input type="hidden" id="full_phone" name="phone">
    </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                <input type="date" name="date_of_birth"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200" />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                <select name="gender"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                    <option value="">Select</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div class="sm:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                <input type="text" name="country"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200" />
            </div>

            <div class="sm:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Files (images & PDFs)</label>
                <input type="file" name="files[]" multiple
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 bg-white" />
            </div>

            <div class="sm:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Comments</label>
                <textarea name="comments" rows="4"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200"></textarea>
            </div>
        </div>

        <div class="pt-4 flex justify-center">
            <button type="submit"
                class="bg-blue-600 text-white font-medium px-6 py-2 rounded-lg hover:bg-blue-700 focus:ring focus:ring-blue-300">
                Submit
            </button>
        </div>
    </form>

    <div id="result" class="mt-4 text-center text-sm font-medium"></div>
</div>
@endsection

@section('scripts')
<script>
document.getElementById('applicationForm').addEventListener('submit', async function(e){
    e.preventDefault();
    const form = e.target;
    const data = new FormData(form);
    const resultDiv = document.getElementById('result');
    resultDiv.textContent = 'Submitting...';
    resultDiv.className = "mt-4 text-center text-sm text-gray-500";

    try {
        const res = await fetch("{{ route('applications.store') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Accept': 'application/json'
            },
            body: data
        });

        const json = await res.json();
        if (res.ok) {
            resultDiv.textContent = json.message;
            resultDiv.className = "mt-4 text-center text-green-600 font-semibold";
            form.reset();
        } else {
            if (json.errors) {
                let msgs = [];
                Object.values(json.errors).forEach(arr => msgs.push(arr.join(', ')));
                resultDiv.textContent = msgs.join(' | ');
                resultDiv.className = "mt-4 text-center text-red-600";
            } else {
                resultDiv.textContent = json.message || 'Error occurred.';
                resultDiv.className = "mt-4 text-center text-red-600";
            }
        }
    } catch (err) {
        resultDiv.textContent = 'Network error. Please try again.';
        resultDiv.className = "mt-4 text-center text-red-600";
    }
});
</script>
@endsection
