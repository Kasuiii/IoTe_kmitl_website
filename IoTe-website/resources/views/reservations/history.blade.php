@extends('layouts.app')

@section('content')
    <div class="max-w-6xl p-6 mx-auto">
        <h1 class="text-2xl font-bold mb-6">My Reservations</h1>

        <table class="w-full border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2">Item</th>
                    <th class="p-2">Borrow</th>
                    <th class="p-2">Return</th>
                    <th class="p-2">Status</th>
                    <th class="p-2"></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($reservations as $r)
                    <tr class="border-t">
                        <td class="p-2">
                            {{ $r->item->name }}
                        </td>

                        <td class="p-2">
                            {{ $r->borrow_date }}
                        </td>

                        <td class="p-2">
                            {{ $r->return_date }}
                        </td>

                        <td class="p-2">
                            {{ $r->status }}
                        </td>

                        <td class="p-2">
                            @if ($r->status === 'pending')
                                <form method="POST" action="{{ route('reservations.cancel', $r->id) }}">
                                    @csrf
                                    @method('PATCH')

                                    <button class="text-red-600">Cancel</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
