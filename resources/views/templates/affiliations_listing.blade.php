
  <main class="content__wrapper affiliation__template">
      <section class="affiliation__card__section [ position-relative py-5 ]" >
          <div class="container">
              <div class="row g-5">
                  <div class="col-12" >
                      @foreach($data as $content )
                      <div class="affiliation__card__container [ d-flex ]">
                          <div class="affiliation__card__thumbnail__image">
                              <img src="{{Storage::url($content->image)}}" alt="affiliateCardDataImage" />
                              <div class="affiliation__card__thumbnail__image__logo__container">
                                  <div class="__logo">
                                      <img src="" alt="" width="250" />
                                  </div>
                                  <a href="" class="__url" target="__blank"></a>
                              </div>
                          </div>
                          <div class="affiliation__card__content">
                              <h1>
                                  <a href="javascript:void(0)">{{$content->name}}</a>
                              </h1>
                              <p>{{$content->detail}}</p>
                              <a href="javascript:void(0)">Read More</a>
                          </div>
                      </div>
                      @endforeach
                  </div>
              </div>
          </div>
      </section>
  </main>
