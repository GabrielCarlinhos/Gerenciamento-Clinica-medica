import { ComponentFixture, TestBed } from '@angular/core/testing';

import { DoutoresPrincipalComponent } from './doutores-principal.component';

describe('DoutoresPrincipalComponent', () => {
  let component: DoutoresPrincipalComponent;
  let fixture: ComponentFixture<DoutoresPrincipalComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [DoutoresPrincipalComponent]
    });
    fixture = TestBed.createComponent(DoutoresPrincipalComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
