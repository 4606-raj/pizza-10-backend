<div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Menu Items</label>
        <div class="col-sm-9">
            @foreach ($selectedValues as $index => $selectedValue)
                <div class="row new-menu-item">
                    <div class="col-sm-12">
                        <select class="form-control mb-2" name="menu_items[{{ $index }}][id]" wire:model.live="selectedValues.{{ $index }}">
                            <option value="">Select a Menu Item</option>
                            @foreach ($menuItems as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <input type="number" class="form-control" name="menu_items[{{ $index }}][quantity]" value="1" wire:model.live="quantities.{{ $index }}">
                    </div>

                    <div class="col-sm-6">
                        <select class="form-control mb-2" name="menu_items[{{ $index }}][base_id]" wire:model.live="selectedBases.{{ $index }}">
                            <option value="">Select a base</option>
                            @foreach ($bases as $item)
                                <option value="{{ $item->id }}" {{ $item->id == 1? 'selected': '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if ($index > 0)
                        <button type="button" class="btn btn-danger mt-4 col-6" wire:click="removeMenuItem({{ $index }})">Remove</button>
                    @endif
                </div>

                <hr>
                
            @endforeach
        </div>
    </div>

    <div class="col-sm-3">
        <button type="button" class="btn btn-success" wire:click="addMenuItem">Add More</button>
    </div>
</div>
