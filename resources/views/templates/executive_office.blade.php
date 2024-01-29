
  <main class="content__wrapper profile__listing__template">
    <section class="council__members__section [ position-relative py-5 ]" class="footer__membership__card__gap mb-4">
      <div class="container">
          <div class="row g-4">
          @foreach($data as $content )
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 d-flex" >
              <div class="council__members__card">
                <div class="council__members__card__profile__image">
                  <img src="{{Storage::url($content->image)}}" :alt="card.imgAlt" />
                </div> 
                <div class="council__members__card__details">
                  <h5>{{$content->name}}</h5>
                  <p>{{$content->credentails}}</p>
                  <p><strong>{{$content->job_title}}</strong></p>
                </div>
              </div>
            </div>
          @endforeach
          </div>
        </div>
    </section>
  </main>
