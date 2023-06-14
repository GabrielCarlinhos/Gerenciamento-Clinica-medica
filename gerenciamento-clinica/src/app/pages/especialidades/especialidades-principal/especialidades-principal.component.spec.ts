import { ComponentFixture, TestBed } from '@angular/core/testing';

import { EspecialidadesPrincipalComponent } from './especialidades-principal.component';

describe('EspecialidadesPrincipalComponent', () => {
  let component: EspecialidadesPrincipalComponent;
  let fixture: ComponentFixture<EspecialidadesPrincipalComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [EspecialidadesPrincipalComponent]
    });
    fixture = TestBed.createComponent(EspecialidadesPrincipalComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
