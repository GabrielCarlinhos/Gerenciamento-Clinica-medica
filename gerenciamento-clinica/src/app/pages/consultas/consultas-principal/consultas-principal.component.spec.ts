import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ConsultasPrincipalComponent } from './consultas-principal.component';

describe('ConsultasPrincipalComponent', () => {
  let component: ConsultasPrincipalComponent;
  let fixture: ComponentFixture<ConsultasPrincipalComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [ConsultasPrincipalComponent]
    });
    fixture = TestBed.createComponent(ConsultasPrincipalComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
