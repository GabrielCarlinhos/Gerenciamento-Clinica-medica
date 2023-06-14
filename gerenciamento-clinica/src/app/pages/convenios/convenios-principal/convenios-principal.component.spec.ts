import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ConveniosPrincipalComponent } from './convenios-principal.component';

describe('ConveniosPrincipalComponent', () => {
  let component: ConveniosPrincipalComponent;
  let fixture: ComponentFixture<ConveniosPrincipalComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [ConveniosPrincipalComponent]
    });
    fixture = TestBed.createComponent(ConveniosPrincipalComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
