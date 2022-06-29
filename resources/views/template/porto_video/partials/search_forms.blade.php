<form 
                        action='{{route("binshopsblog.search", app('request')->get('locale'))}}' 
                        method="get"
                    >
                        <div class="input-group mb-3 pb-1">
                            <input 
                            class="form-control text-1" placeholder="Pencarian..." name="s" id="s" type="text">
                            <button type="submit" class="btn btn-dark text-1 p-2"><i class="fas fa-search m-2"></i></button>
                        </div>
                    </form>